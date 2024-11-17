<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\Domain\Repository;

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

use Madj2k\CatSearch\Domain\DTO\Search;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Class AbstractRepository
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
abstract class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @const string
     */
    const TABLE_FILTERABLE = 'tx_catsearch_domain_model_filterable';


    /**
     * @const string
     */
    const MM_RELATIONS_BY_RECORD_TYPE = [
        0 => [
            'related_filterable_documents' => 'related_filterable_products',
            'related_filterable_accessories' => 'related_filterable_products2',
        ],
        1 =>[
            'related_filterable_documents' => 'related_filterable_products',
        ],
        3 => [
            'related_filterable_accessories' => 'related_filterable_products2',
        ],
    ];


    /**
	 * @var \TYPO3\CMS\Core\Database\ConnectionPool|null
	 */
	protected ?ConnectionPool $connectionPool = null;


	/**
	 * @var string
	 */
	protected string $tableName = '';


	/**
	 * @param \TYPO3\CMS\Core\Database\ConnectionPool $connectionPool
	 * @return void
	 */
	public function injectConnectionPool(ConnectionPool $connectionPool): void
	{
		$this->connectionPool = $connectionPool;
	}


	/**
	 * Return the current table name
	 *
	 * @return string
	 * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
	 */
	protected function getTableName(): string
	{
		if (!$this->tableName) {

			$className = $this->createQuery()->getType();

			/** @var \TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper $dataMapper */
			$dataMapper = GeneralUtility::makeInstance(DataMapper::class);

			$this->tableName = $dataMapper->getDataMap($className)->getTableName();
		}

		return $this->tableName;
	}


    /**
     * @param array $settings
     * @return array
     */
    protected function getRecordTypeFilter(array $settings): array
    {
        $tableName = self::TABLE_FILTERABLE;

        // filter by recordType
        if (
            (isset($settings['recordType']))
            && ($recordType = $settings['recordType'])
            && (isset($GLOBALS['TCA'][$tableName]['ctrl']['type']))
            && ($typeField = $GLOBALS['TCA'][$tableName]['ctrl']['type'])
        ){
            return [
                'field' => $typeField,
                'value' => $recordType
            ];
        }

        return [];
    }


    /**
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @param array $settings
     * @param array $constraints
     * @param \Madj2k\CatSearch\Domain\DTO\Search|null $search
     * @return array
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    protected function addSingleSelectIncludeFilterConstraint(
        QueryInterface $query,
        array $settings,
        array &$constraints = [],
        ?Search $search = null
    ): array {

        // get all single filters. We use AND here
        if ($filters = $search->getAllSingleFilters()) {
            foreach ($filters as $filter) {
                if ($filter){
                    $constraints[] = $query->contains('filters', $filter);
                }
            }
        }

        return $constraints;
    }


    /**
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @param array $settings
     * @param array $constraints
     * @param \Madj2k\CatSearch\Domain\DTO\Search|null $search
     * @return array
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    protected function addMultiSelectIncludeFilterConstraint(
        QueryInterface $query,
        array $settings,
        array &$constraints = [],
        ?Search $search = null
    ): array {

        // add multiple filters and pre-filter - but with OR-constrain!
        $filters = [];
        if ($search) {
            $filters = $search->getAllMultiSelectFilters();
        }

        if (
            (isset($settings['filter']))
            && ($preFilter = GeneralUtility::trimExplode(',', $settings['filter'], true))
        ){
            $filters[] = $preFilter;
        }

        if ($filters) {
            foreach ($filters as $filter) {

                $subConstraints = [];
                foreach ($filter as $filterValue) {
                    if ($filterValue) {
                        $subConstraints[] = $query->contains('filters', $filterValue);
                    }
                }

                if (!empty($subConstraints)) {
                    $constraints[] = $query->logicalOr(...$subConstraints);
                }
            }
        }

        return $constraints;
    }


    /**
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @param array $settings
     * @param array $constraints
     * @param \Madj2k\CatSearch\Domain\DTO\Search|null $search
     * @return array
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    protected function addExcludeFilterConstraint(
        QueryInterface $query,
        array $settings,
        array &$constraints = [],
        ?Search $search = null
    ): array {

        if ((isset($settings['filterExclude']))
            && ($filters = GeneralUtility::trimExplode(',', $settings['filterExclude'], true))
        ){
            $subConstraints = [];
            foreach ($filters as $filter) {
                if ($filter){
                    $subConstraints[] = $query->contains('filters', $filter);
                }
            }

            if (!empty($subConstraints)){
                $constraints[] = $query->logicalNot(...$subConstraints);
            }
        }

        return $constraints;
    }


    /**
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @param array $settings
     * @param array $constraints
     * @param \Madj2k\CatSearch\Domain\DTO\Search|null $search
     * @return array
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    protected function addRelatedFilterableConstraint(
        QueryInterface $query,
        array $settings,
        array &$constraints = [],
        ?Search $search = null
    ): array {

        // search for related product
        if ($search) {
            if ($product = $search->getRelatedProduct()) {

                if ($fields = $this->getRelatedFieldNamesByRecordType((int) $settings['recordType'], false)) {

                    $subConstraints = [];
                    foreach ($fields as $field) {
                        $subConstraints[] = $query->contains(
                            GeneralUtility::underscoredToLowerCamelCase($field), $product
                        );
                    }

                    $constraints[] = $query->logicalOr(...$subConstraints);
                }
            }
        }

        return $constraints;
    }


    /**
     * Find all filterables that have another filterables assigned
     *
     * @param string $localField
     * @param int $languageUid
     * @param $settings
     * @return array
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    protected function findAllFilterablesAssignedToMMField(string $localField, int $languageUid, $settings): array
    {
        $tableName = $this->getTableName();
        $orderField = 'title';

        // get foreign table and change join field in case of l10nMode == exclude
        $isRelationField = isset($GLOBALS['TCA'][$tableName]['columns'][$localField]['config']['foreign_table']);
        if ($isRelationField) {

            $joinField = 'uid_local';
            $mmTable = $GLOBALS['TCA'][$tableName]['columns'][$localField]['config']['MM'] ?? '';
            $languageField = $GLOBALS['TCA'][$tableName]['ctrl']['languageField'] ?? '';

            // check if we have to go in the opposite direction
            $oppositeField = $GLOBALS['TCA'][$tableName]['columns'][$localField]['config']['MM_opposite_field'] ?? '';
            if ($oppositeField) {
                $joinField = 'uid_foreign';
            }

            /** @var \TYPO3\CMS\Core\Database\ConnectionPool $connectionPool */
            $connectionPool = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ConnectionPool::class);

            /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder */
            $queryBuilder = $connectionPool->getQueryBuilderForTable($tableName);

            $queryBuilder
                ->select('*')
                ->from($tableName)
                ->innerJoin(
                    $tableName,
                    $mmTable,
                    $mmTable,
                    $queryBuilder->expr()->eq(
                        $mmTable .'.' . $joinField,
                        $queryBuilder->quoteIdentifier($tableName. '.uid')
                    )
                )
                ->groupBy($tableName . '.uid');

            // add sorting
            if ($GLOBALS['TCA'][$tableName]['columns'][$orderField]) {
                $queryBuilder->orderBy($orderField, \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
            }

            $constraints = [];
            if ($languageField) {
                $constraints[] =  $queryBuilder->expr()->eq(
                    $tableName . '.' .$languageField,
                    $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
                );
            }

            $queryBuilder->where(...$constraints);
            $statement = $queryBuilder->executeQuery();
            $result = $statement->fetchAllAssociative();

            $finalResult = [];
            if ($result) {
                foreach ($result as $row) {
                    $finalResult[$row['uid']] = $row[$orderField];
                }
            }

            return $finalResult;
        }

        return [];
    }



    /**
     * Get all used data of given field in grouped manner for filters
     *
     * @param string $localField
     * @param int $languageUid
     * @param array $settings
     * @return array|null
     * @throws \Doctrine\DBAL\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     */
    public function findAllAssignedToField(string $localField, int $languageUid, array $settings): ?array
    {
        $tableName = $this->getTableName();

        /** @var \TYPO3\CMS\Core\Database\ConnectionPool $connectionPool */
        $connectionPool = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ConnectionPool::class);

        // select only local field - or in case of relation all related table field plus the local field
        $selectFields[] = $tableName . '.' . $localField;
        $orderField =  $localField;
        $languageField = $GLOBALS['TCA'][$tableName]['ctrl']['languageField'] ?? '';

        $foreignTable = '';
        $joinUid = 'uid';
        $l10nMode = '';

        // get foreign table and change join field in case of l10nMode == exclude
        $isRelationField = isset($GLOBALS['TCA'][$tableName]['columns'][$localField]['config']['foreign_table']);
        if ($isRelationField) {
            $foreignTable = $GLOBALS['TCA'][$tableName]['columns'][$localField]['config']['foreign_table'];
            $foreignTableLanguageField = $GLOBALS['TCA'][$tableName]['ctrl']['languageField'] ?? '';

            $selectFields[] = $foreignTable . '.*';
            $orderField = 'title';

            // check translation-setup
            $l10nMode = $GLOBALS['TCA'][$tableName]['columns'][$localField]['l10n_mode'] ?? '';
            if (
                ($l10nMode == 'exclude')
                && ($foreignTableLanguageField)
                && ($languageUid > 0)
                && (isset($GLOBALS['TCA'][$foreignTable]['ctrl']['transOrigPointerField']))
            ){
                $joinUid = $GLOBALS['TCA'][$foreignTable]['ctrl']['transOrigPointerField'];
            }
        }

        /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder */
        $queryBuilder = $connectionPool->getQueryBuilderForTable($tableName);
        $queryBuilder
            ->select(...$selectFields)
            ->from($tableName)
            ->groupBy($tableName . '.' . $localField);

        $constraints = [];
        $constraints[] = $queryBuilder->expr()->eq(
            $tableName . '.' . $languageField,
            $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
        );

        // filter by recordType
        $constraints = [];
        if ($recordTypeFilter = $this->getRecordTypeFilter($settings)) {
            $constraints[] = $queryBuilder->expr()->eq(
                $tableName . '.' . $recordTypeFilter['field'],
                $queryBuilder->createNamedParameter($recordTypeFilter['value'], \PDO::PARAM_INT)
            );
        }

        // check if the values in question are IDs - there can't be a mm-relation here!!!
        if ($isRelationField) {
            $queryBuilder->join(
                $tableName,
                $foreignTable,
                $foreignTable,
                $queryBuilder->expr()->eq(
                    $foreignTable .'.' . $joinUid,
                    $queryBuilder->quoteIdentifier($tableName. '.' . $localField)
                )
            );

            // translation handling if excluded from translation
            if (
                ($languageUid > 0)
                && ($l10nMode == 'exclude')
                && ($foreignTableLanguageField)
            ) {
                $constraints[] =  $queryBuilder->expr()->eq(
                    $foreignTable . '.' . $foreignTableLanguageField,
                    $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
                );
            }
        }

        $queryBuilder->where(...$constraints);

        // add sorting
        if ($GLOBALS['TCA'][$tableName]['columns'][$orderField]) {
            $queryBuilder->orderBy($orderField, \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
        }

        $statement = $queryBuilder->executeQuery();
        return $statement->fetchAllAssociative();
    }


    /**
     * Get fieldname for relations to filterables
     *
     * @param int $recordType
     * @param bool $invert
     * @return array
     */
    protected function getRelatedFieldNamesByRecordType(int $recordType, bool $invert = false): array
    {

        if (isset(self::MM_RELATIONS_BY_RECORD_TYPE[$recordType])) {
            if ($invert) {
                return array_flip(self::MM_RELATIONS_BY_RECORD_TYPE[$recordType]);
            }

            return self::MM_RELATIONS_BY_RECORD_TYPE[$recordType];
        }

        return [];
    }
}
