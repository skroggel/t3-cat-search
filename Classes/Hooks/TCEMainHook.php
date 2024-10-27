<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\Hooks;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\DataHandling\SlugHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * Class TCEMainHook
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class TCEMainHook
{

	/**
	 * Process additional data before it is saved to the database
	 *
	 * @param string $status
	 * @param string $table The name of the table the data should be saved to
	 * @param string $id The uid of the page we are currently working on
	 * @param array $fieldArray The array of fields and values that have been saved to the datamap
	 * @param object $parentObj The parent object that triggered this hook
	 * @return void
	 */
    public function processDatamap_postProcessFieldArray(
        string $status,
        string $table,
        string $id,
        array &$fieldArray,
        object &$parentObj
    ): void {

        try {

            $configReader = GeneralUtility::makeInstance(ExtensionConfiguration::class);
            $extensionConfig = $configReader->get('cat_search');

			// save year in well formated way in order to be able to search effectively
			if (
                ($indexTable = $extensionConfig['indexTable'])
                && ($table == $indexTable)
            ){

				if (
                    (isset($fieldArray['publish_date']))
                    && ($fieldArray['publish_date'])
                ) {
					$fieldArray['publish_date_year'] = date('Y', $fieldArray['publish_date']);
				}

				if (
                    (isset($fieldArray['title']))
                    && ($fieldArray['title'])
                ){
					$fieldArray['title_cleaned'] = strip_tags($fieldArray['title']);

					// set slug if freshly created
					if (!is_numeric($id)) {

						/** @var \TYPO3\CMS\Core\DataHandling\SlugHelper $slugHelper */
						$slugHelper = GeneralUtility::makeInstance(SlugHelper::class,
							$table, 'slug', []
						);
						$fieldArray['slug'] = $slugHelper->sanitize($fieldArray['title_cleaned']);
					}
				}
			}

        } catch (\Exception $e) {
            // do nothing
        }
    }


	/**
	 * Index all contents of items
	 *
	 * @param \TYPO3\CMS\Core\DataHandling\DataHandler $parentObj The parent object that triggered this hook
	 * @return void
	 */
	public function processDatamap_afterAllOperations(
		\TYPO3\CMS\Core\DataHandling\DataHandler $parentObj
	): void {

		try {

            // load configuration for indexer
            $configReader = GeneralUtility::makeInstance(ExtensionConfiguration::class);
            $extensionConfig = $configReader->get('cat_search');
            if (
                ($indexTable = $extensionConfig['indexTable'])
                && ($indexFields = $this->explodeDotNotation($extensionConfig['indexFields']))
            ){
                $this->indexContent($indexTable, $indexFields);
            }

            // flush filter caches
            $cacheManager = GeneralUtility::makeInstance(CacheManager::class);
            $cacheManager->flushCachesByTag('madj2kcatsearch_filteroptions');

		} catch (\Exception $e) {
			// do nothing
		}
	}


    /**
     * Fetch all indexable contents for the given table
     *
     * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
     * @throws \Doctrine\DBAL\Exception
     */
    protected function indexContent (
        string $table,
        array $indexerConfig,
    ): bool {

        if (count($indexerConfig)) {

            $selectFields = $this->buildSelectFields(
                $table,
                array_keys($indexerConfig)
            );

            /** @var \TYPO3\CMS\Core\Database\ConnectionPool $connectionPool*/
            $connectionPool = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ConnectionPool::class);

            /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder */
            $queryBuilder = $connectionPool->getQueryBuilderForTable($table);
            $queryBuilder
                ->select(...$selectFields)
                ->from($table)
                ->where(
                    $queryBuilder->expr()->gt(
                        'tstamp',
                        'content_index_tstamp'
                    ),
                );

            $statement = $queryBuilder->executeQuery();
            $records = $statement->fetchAllAssociative();
            foreach ($records as $record) {

                $indexResult = $this->buildIndexResultRecursive($table, $record, $indexerConfig);

                // now save indexResult to database - may also be empty after deletions!
                $queryBuilderUpdate = $connectionPool->getQueryBuilderForTable($table);
                $queryBuilderUpdate
                    ->update($table)
                    ->where(
                        $queryBuilderUpdate->expr()->eq(
                            'uid',
                            $queryBuilderUpdate->createNamedParameter(
                                $record['uid'],
                                \PDO::PARAM_INT
                            )
                        )
                    )
                    ->set('content_index', $indexResult)
                    ->set('content_index_tstamp', time())
                    ->executeStatement();
            }

            return true;
        }

        return false;
    }


    /**
     * Fetch all indexable related contents for the given table
     *
     * @param string $parentTable
     * @param string $parentColumn
     * @param array $parentRecord
     * @param array $indexerConfig
     * @return string
     * @throws \Doctrine\DBAL\Exception
     * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
     */
	protected function indexRelatedContent (
        string $parentTable,
        string $parentColumn,
        array $parentRecord,
        array $indexerConfig,
	): string {

        $indexResult = '';
        $tcaConfig = $GLOBALS['TCA'][$parentTable]['columns'][$parentColumn]['config'];

        if (
            (count($indexerConfig))
            && (isset($tcaConfig['foreign_table']))
            && ($table = $tcaConfig['foreign_table'])
        ) {

            /** @var \TYPO3\CMS\Core\Database\ConnectionPool $connectionPool*/
            $connectionPool = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ConnectionPool::class);

            // get select fields
            $selectFields = $this->buildSelectFields(
                $table,
                array_keys($indexerConfig)
            );

            /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder */
            $queryBuilder = $connectionPool->getQueryBuilderForTable($table);
            $queryBuilder
                ->select(...$selectFields)
                ->from($table);

            // MM-relation
            if (
                (isset($tcaConfig['MM']))
                && ($mmTable = $tcaConfig['MM'])
            ) {

                $queryBuilder->join(
                    $table,
                    $mmTable,
                    $mmTable,
                    $queryBuilder->expr()->eq(
                        $mmTable  . '.uid_local',
                        $queryBuilder->createNamedParameter(
                            $parentRecord['uid'],
                            \PDO::PARAM_INT
                        )
                    )
                )
                ->groupBy($table . '.uid')
                ->orderBy($mmTable  . '.sorting_foreign');

            // n:1-relation with defined foreign_field
            } else if (
                (isset($tcaConfig['foreign_field']))
                && ($parentUidField = $tcaConfig['foreign_field'])
            ){

                $queryBuilder->where(
                    $queryBuilder->expr()->eq(
                        $parentUidField,
                        $queryBuilder->createNamedParameter(
                            $parentRecord['uid'],
                            \PDO::PARAM_INT
                        )
                    )
                );

                if ($parentTableField = $tcaConfig['foreign_table_field']) {
                    $queryBuilder->andWhere(
                        $queryBuilder->expr()->eq(
                            $parentTableField,
                            $queryBuilder->createNamedParameter(
                                $parentTable,
                                \PDO::PARAM_STR
                            )
                        )
                    );
                }

                if (
                    (isset($tcaConfig['foreign_sortby']))
                    && ($sorting = $tcaConfig['foreign_sortby'])
                ) {
                    $queryBuilder->orderBy($sorting);
                }

            // 1:n-relation based on comma-list (or single value)
            } else {

                $uidList = GeneralUtility::trimExplode(',', ($parentRecord[$parentColumn] ?? ''));
                $queryBuilder->where(
                    $queryBuilder->expr()->in(
                        'uid',
                        $queryBuilder->createNamedParameter(
                            $uidList,
                            Connection::PARAM_INT_ARRAY
                        )
                    )
                );
            }

            $statement = $queryBuilder->executeQuery();
            $records = $statement->fetchAllAssociative();
            foreach ($records as $record) {
                $indexResult .= $this->buildIndexResultRecursive($table, $record, $indexerConfig);
            }
        }

        return trim($indexResult);
	}


    /**
     * Build the index-array and call fetchRelatedContent recursively if needed
     *
     * @param string $table
     * @param array $record
     * @param array $indexerConfig
     * @return string
     * @throws \Doctrine\DBAL\Exception
     * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
     */
    protected function buildIndexResultRecursive (
        string $table,
        array $record,
        array $indexerConfig
    ): string {

        $indexResult = '';
        foreach ($indexerConfig as $column => $indexSubConfig) {

            if (count($indexSubConfig)) {
                $indexResult .= ' ' . $this->indexRelatedContent(
                    $table,
                    $column,
                    $record,
                    $indexSubConfig
                );

            } else {
                if ($record[$column]) {
                    $indexResult .= ' ' . trim(strip_tags($record[$column]));
                }
            }
        }

        return $indexResult;
    }


	/**
	 * Returns only existing fields for given table
	 *
	 * @param string $table
	 * @param array $fields
	 * @return array
	 */
	protected function buildSelectFields (string $table, array $fields): array
	{
		$cleanedFields = [];
		foreach ($fields as $field) {
			if (isset($GLOBALS['TCA'][$table]['columns'][$field])) {
				$cleanedFields[] = $field;
			}
		}

        $cleanedFields[] = 'uid';
		return $cleanedFields;
	}


    /**
     * Explode dot-notation from configuration
     *
     * @param string $string
     * @return array
     */
    protected function explodeDotNotation (string $string): array {

        $exploded = GeneralUtility::trimExplode(',', $string);
        $result = [];
        foreach ($exploded as $fieldsDotNotation) {
            $undottedArray = [];
            $this->dotStringToArray($undottedArray, $fieldsDotNotation);
            $result = array_merge_recursive($result, $undottedArray);
        }

        return $result;
    }


    /**
     * @param array $array
     * @param string $path
     * @param string $separator
     * @return void
     * @see https://stackoverflow.com/questions/9635968/convert-dot-syntax-like-this-that-other-to-multi-dimensional-array-in-php
     */
    function dotStringToArray(array &$array, string $path, string $separator ='.'): void
    {
        $keys = explode($separator, $path);
        foreach ($keys as $key) {
            $array = &$array[$key];
        }

        $array = [];
    }

}
