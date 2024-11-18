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
    const TABLE_FILTER = 'tx_catsearch_domain_model_filter';


    /**
     * @const string
     */
    const TABLE_FILTER_TYPE = 'tx_catsearch_domain_model_filtertype';


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
	public function getTableName(): string
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
     * Adds the constraints for a single select filter
     *
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
            foreach ($filters as $filterValue) {
                if ($filterValue){
                    $constraints[] = $query->logicalOr(
                        $query->contains('filters', $filterValue),
                        $query->equals('primaryFilter1', $filterValue),
                        $query->equals('primaryFilter2', $filterValue),
                        $query->equals('primaryFilter3', $filterValue),
                        $query->equals('primaryFilter4', $filterValue),
                        $query->equals('primaryFilter5', $filterValue)
                    );
                }
            }
        }

        return $constraints;
    }


    /**
     * Adds the constraints for a multi-select filter
     *
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
                        $subConstraints[] = $query->equals('primaryFilter1', $filterValue);
                        $subConstraints[] = $query->equals('primaryFilter2', $filterValue);
                        $subConstraints[] = $query->equals('primaryFilter3', $filterValue);
                        $subConstraints[] = $query->equals('primaryFilter4', $filterValue);
                        $subConstraints[] = $query->equals('primaryFilter5', $filterValue);
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
     * Adds the constraints for an exclude filter
     *
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
            foreach ($filters as $filterValue) {
                if ($filterValue){
                    $subConstraints[] = $query->logicalNot($query->contains('filters', $filterValue));
                    $subConstraints[] = $query->logicalNot($query->equals('primaryFilter1', $filterValue));
                    $subConstraints[] = $query->logicalNot($query->equals('primaryFilter2', $filterValue));
                    $subConstraints[] = $query->logicalNot($query->equals('primaryFilter3', $filterValue));
                    $subConstraints[] = $query->logicalNot($query->equals('primaryFilter4', $filterValue));
                    $subConstraints[] = $query->logicalNot($query->equals('primaryFilter5', $filterValue));
                }
            }

            if (!empty($subConstraints)){
                $constraints[] = $query->logicalAnd(...$subConstraints);
            }
        }

        return $constraints;
    }


    /**
     * Adds the constraints for a search for related filterables
     *
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
     * Returns the query params for filtering by record type
     *
     * @param array $settings
     * @param string $tableName
     * @return array
     */
    protected function getRecordTypeQueryParams(array $settings, string $tableName = self::TABLE_FILTERABLE): array
    {
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
     * Returns the query params for filtering by filter type
     *
     * @param int $filterTypeUid
     * @param int $languageUid
     * @param string $localTable
     * @return array
     * @throws \Doctrine\DBAL\Exception
     */
    protected function getFilterTypeQueryParams(int $filterTypeUid, int $languageUid, string $localTable = self::TABLE_FILTER): array
    {

        if (
            ($filterTypeUid)
            && ($GLOBALS['TCA'][$localTable]['columns']['type'])
        ){

            if ($languageUid > 0) {

                $localTable = self::TABLE_FILTER_TYPE;
                $localLanguageField = $GLOBALS['TCA'][$localTable]['ctrl']['languageField'] ?? '';
                $localUid = 'uid';
                if (isset($GLOBALS['TCA'][$localTable]['ctrl']['transOrigPointerField'])) {
                    $localUid = $GLOBALS['TCA'][$localTable]['ctrl']['transOrigPointerField'];
                }

                if ($localLanguageField) {
                    /** @var \TYPO3\CMS\Core\Database\ConnectionPool $connectionPool */
                    $connectionPool = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ConnectionPool::class);

                    /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder */
                    $queryBuilder = $connectionPool->getQueryBuilderForTable($localTable);
                    $queryBuilder
                        ->select('uid')
                        ->from($localTable, 'local_table')
                        ->where(
                            $queryBuilder->expr()->eq(
                                'local_table.' . $localUid,
                                $queryBuilder->createNamedParameter($filterTypeUid, \PDO::PARAM_INT)
                            ),
                            $queryBuilder->expr()->eq(
                                'local_table.' . $localLanguageField,
                                $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
                            ),
                        );

                    if ($result = $queryBuilder->executeQuery()->fetchFirstColumn()) {
                        return [
                            'field' => 'type',
                            'value' => $result[0]
                        ];
                    }
                }
            }

            return [
                'field' => 'type',
                'value' => $filterTypeUid
            ];
        }

        return [];
    }


    /**
     * Find all active filterables via mm-relation in grouped manner for filters
     *
     * @param string $localField
     * @param string $localTable
     * @param int $typeUid
     * @param int $languageUid
     * @param array $settings
     * @param string $orderField
     * @param string $orderDirection
     * @return array
     * @throws \Doctrine\DBAL\Exception
     */
    public function findGroupedByMMField(
        string $localField,
        string $localTable,
        int $typeUid,
        int $languageUid,
        array $settings,
        string $orderField = 'title',
        string $orderDirection = \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    ): array {

        if (! $GLOBALS['TCA'][$localTable]['columns'][$localField]) {
            return [];
        }

        // get foreign table and change join field in case of l10nMode == exclude
        $isRelationField = isset($GLOBALS['TCA'][$localTable]['columns'][$localField]['config']['foreign_table']);
        if ($isRelationField) {

            $mmTable = $GLOBALS['TCA'][$localTable]['columns'][$localField]['config']['MM'] ?? '';
            $mmLocalField = 'uid_local';
            $mmForeignField = 'uid_foreign';

            // check if we have to go in the opposite direction
            $oppositeField = $GLOBALS['TCA'][$localTable]['columns'][$localField]['config']['MM_opposite_field'] ?? '';
            if ($oppositeField) {
                $mmLocalField = 'uid_foreign';
                $mmForeignField = 'uid_local';
            }

            $localLanguageField = $GLOBALS['TCA'][$localTable]['ctrl']['languageField'] ?? '';
            $localUid = 'uid';

            $foreignTable = $GLOBALS['TCA'][$localTable]['columns'][$localField]['config']['foreign_table'] ?? '';
            $foreignLanguageField = $GLOBALS['TCA'][$foreignTable]['ctrl']['languageField'] ?? '';
            $foreignUid = 'uid';

            // check translation-setup
            $l10nMode = $GLOBALS['TCA'][$localTable]['columns'][$localField]['l10n_mode'] ?? '';
            if ($languageUid > 0){

                if (
                    ($localLanguageField)
                    && (isset($GLOBALS['TCA'][$localTable]['ctrl']['transOrigPointerField']))
                ) {
                    $localUid = $GLOBALS['TCA'][$localTable]['ctrl']['transOrigPointerField'];
                }

                if ($l10nMode == 'exclude') {
                    if (
                        ($foreignLanguageField)
                        && (isset($GLOBALS['TCA'][$foreignTable]['ctrl']['transOrigPointerField']))
                    ) {
                        $foreignUid = $GLOBALS['TCA'][$foreignTable]['ctrl']['transOrigPointerField'];
                    }
                }
            }

            /** @var \TYPO3\CMS\Core\Database\ConnectionPool $connectionPool */
            $connectionPool = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ConnectionPool::class);

            /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder */
            $queryBuilder = $connectionPool->getQueryBuilderForTable($localTable);

            $queryBuilder
                ->select('local_table.*')
                ->from($localTable, 'local_table')
                ->innerJoin(
                    'local_table',
                    $mmTable,
                    'mm_table',
                    $queryBuilder->expr()->eq(
                        'mm_table.' . $mmLocalField,
                        $queryBuilder->quoteIdentifier('local_table.' . $localUid)
                    )
                )
                ->leftJoin(
                'local_table',
                    $foreignTable,
                    'foreign_table',
                    $queryBuilder->expr()->eq(
                        'mm_table.' . $mmForeignField,
                        $queryBuilder->quoteIdentifier('foreign_table.' . $foreignUid)
                    )
                )
                ->groupBy('local_table.uid');

            // filter by language
            $constraints = [];
            if ($localLanguageField) {
                $constraints[] =  $queryBuilder->expr()->eq(
                    'local_table.' .$localLanguageField,
                    $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
                );
            }

            if ($foreignLanguageField) {
                $constraints[] =  $queryBuilder->expr()->eq(
                    'foreign_table.' . $foreignLanguageField,
                    $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
                );
            }

            // filter local table by type if possible
            if ($filterTypeParams = $this->getFilterTypeQueryParams($typeUid, $languageUid, $localTable)) {
                $constraints[] = $queryBuilder->expr()->eq(
                    'local_table.' . $filterTypeParams['field'],
                    $queryBuilder->createNamedParameter($filterTypeParams['value'], \PDO::PARAM_INT)
                );
            }

            // filter foreign-table by record type
            if ($recordTypeParams = $this->getRecordTypeQueryParams($settings, $foreignTable)) {
                $constraints[] = $queryBuilder->expr()->eq(
                     'foreign_table.' . $recordTypeParams['field'],
                    $queryBuilder->createNamedParameter($recordTypeParams['value'], \PDO::PARAM_INT)
                );
            }

            // add sorting
            if ($GLOBALS['TCA'][$localTable]['columns'][$orderField]) {
                $queryBuilder->orderBy($orderField, $orderDirection);
            }

            $queryBuilder->where(...$constraints);

            $statement = $queryBuilder->executeQuery();
            $result = $statement->fetchAllAssociative();

            if ($result) {
                return $result;
            }
        }

        return [];
    }


    /**
     * Get data of given field in grouped manner for filters
     *
     * @param string $localField
     * @param string $localTable
     * @param int $typeUid
     * @param int $languageUid
     * @param array $settings
     * @param string $orderField
     * @param string $orderDirection
     * @return array
     * @throws \Doctrine\DBAL\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     */
    public function findGroupedByField(
        string $localField,
        string $localTable,
        int $typeUid,
        int $languageUid,
        array $settings,
        string $orderField = 'title',
        string $orderDirection = \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    ): array
    {
        if (! $localTable) {
            $localTable = $this->getTableName();
        }

        if (! $GLOBALS['TCA'][$localTable]['columns'][$localField]) {
            return [];
        }

        /** @var \TYPO3\CMS\Core\Database\ConnectionPool $connectionPool */
        $connectionPool = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ConnectionPool::class);

        // select only local field - or in case of relation all related table field plus the local field
        $selectFields[] = 'local_table.' . $localField;
        $localLanguageField = $GLOBALS['TCA'][$localTable]['ctrl']['languageField'] ?? '';

        $foreignTable = '';
        $foreignUid = 'uid';

        // get foreign table and change join field in case of l10nMode == exclude
        $isRelationField = isset($GLOBALS['TCA'][$localTable]['columns'][$localField]['config']['foreign_table']);
        if ($isRelationField) {
            $foreignTable = $GLOBALS['TCA'][$localTable]['columns'][$localField]['config']['foreign_table'];
            $foreignLanguageField = $GLOBALS['TCA'][$foreignTable]['ctrl']['languageField'] ?? '';
            $selectFields[] = 'foreign_table.*';

            // check translation-setup
            if (
                ($foreignLanguageField)
                && ($languageUid > 0)
                && (isset($GLOBALS['TCA'][$foreignTable]['ctrl']['transOrigPointerField']))
            ){
                $foreignUid = $GLOBALS['TCA'][$foreignTable]['ctrl']['transOrigPointerField'];
            }
        }

        /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder */
        $queryBuilder = $connectionPool->getQueryBuilderForTable($localTable);
        $queryBuilder
            ->select(...$selectFields)
            ->from($localTable, 'local_table')
            ->groupBy('local_table.' . $localField);

        $constraints = [];

        // check if field value of local table is > 0
        $constraints[] = $queryBuilder->expr()->gt(
            'local_table.' . $localField,
            $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)
        );

        //
        if ($localField) {
            $constraints[] = $queryBuilder->expr()->eq(
                'local_table.' . $localLanguageField,
                $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
            );
        }

        // filter by recordType
        if ($recordTypeParams = $this->getRecordTypeQueryParams($settings)) {
            $constraints[] = $queryBuilder->expr()->eq(
                'local_table.' . $recordTypeParams['field'],
                $queryBuilder->createNamedParameter($recordTypeParams['value'], \PDO::PARAM_INT)
            );
        }

        // check if the values in question are IDs - there can't be a mm-relation here!!!
        if ($isRelationField) {
            $queryBuilder->join(
                'local_table',
                $foreignTable,
               'foreign_table',
                $queryBuilder->expr()->eq(
                    'foreign_table.' . $foreignUid,
                    $queryBuilder->quoteIdentifier('local_table.' . $localField)
                )
            );

            // translation handling if excluded from translation
            if (
                ($languageUid > 0)
                && ($foreignLanguageField)
            ) {
                $constraints[] =  $queryBuilder->expr()->eq(
                    'foreign_table.' . $foreignLanguageField,
                    $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
                );
            }

            // filter by type if possible
            if ($filterTypeParams = $this->getFilterTypeQueryParams($typeUid, $languageUid, $foreignTable)) {
                $constraints[] = $queryBuilder->expr()->eq(
                    'foreign_table.' . $filterTypeParams['field'],
                    $queryBuilder->createNamedParameter($filterTypeParams['value'], \PDO::PARAM_INT)
                );
            }
        }

        $queryBuilder->where(...$constraints);

        // add sorting
        if ($GLOBALS['TCA'][$localTable]['columns'][$orderField]) {
            $queryBuilder->orderBy($orderField, $orderDirection);
        }

        $statement = $queryBuilder->executeQuery();
        $result = $statement->fetchAllAssociative();
        if ($result) {
            return $result;
        }

        return [];
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
