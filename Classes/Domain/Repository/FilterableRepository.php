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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * Class FilterableRepository
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FilterableRepository extends AbstractRepository implements FilterableRepositoryInterface
{

    /**
	 * @var array
	 */
	protected $defaultOrderings = [
		'publish_date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
	];


    /**
     * Find all by given search-object
     *
     * @param \Madj2k\CatSearch\Domain\DTO\Search $search
     * @param array $settings
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     */
	public function findBySearch(Search $search, array $settings): QueryResultInterface
	{
		$query = $this->createQuery();
		$constraints = [];

        // filter by recordType
        if ($recordTypeParams = $this->getRecordTypeQueryParams($settings)) {
            $constraints[] = $query->equals($recordTypeParams['field'], $recordTypeParams['value']);
        }

         $this->addSingleSelectIncludeFilterConstraint($query, $settings, $constraints, $search);
         $this->addMultiSelectIncludeFilterConstraint($query, $settings, $constraints, $search);
         $this->addExcludeFilterConstraint($query, $settings, $constraints, $search);
         $this->addRelatedFilterableConstraint($query, $settings, $constraints, $search);

		// search for year
		if ($year = $search->getYear()) {
			$constraints[] = $query->equals('publish_date_year', $year);
		}

		// search for string
		if ($textQuery = $search->getTextQuery()) {
			$constraints[] = $query->logicalOr(
                $query->like('title', '%' . $textQuery .'%'),
                $query->like('teaser', '%' . $textQuery .'%'),
                $query->like('content_index', '%' . $textQuery .'%')
            );
		}

		// Change sorting according to given values - check if given value is configured and the given field defined in TCA
		if (
			(in_array($search->getSorting(), GeneralUtility::trimExplode(',', $settings['sorting'] ?? '')))
			&& ($sorting = explode('#', strtolower($search->getSorting())))
			&& (count($sorting) == 2)
		){
			$orderDirection = QueryInterface::ORDER_ASCENDING;
			$orderColumn = $sorting[0];
			if ($sorting[1] == 'desc') {
				$orderDirection = QueryInterface::ORDER_DESCENDING;
			}

			$query->setOrderings([
                GeneralUtility::underscoredToLowerCamelCase($orderColumn) => $orderDirection
			]);
		}

        // add limit if configured
        if (
            (isset($settings['maxResults'])
            && ($settings['maxResults'] > 0))
        ){
            $query->setLimit((int) $settings['maxResults']);
        }
		$query->matching($query->logicalAnd(...$constraints));
		return $query->execute();
	}


    /**
     * Find all by given settings
     *
     * @param array $settings
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
	public function findBySettings(array $settings): QueryResultInterface
	{
		$query = $this->createQuery();
        $constraints = [];

        $this->addMultiSelectIncludeFilterConstraint($query, $settings, $constraints);
        $this->addExcludeFilterConstraint($query, $settings, $constraints);

		if (
            (isset($settings[$settings['layout']]['limit']))
            && ($limit = intval($settings[$settings['layout']]['limit']))
        ){
			$query->setLimit($limit);
		}

        // filter by recordType
        if ($recordTypeParams = $this->getRecordTypeQueryParams($settings)) {
            $constraints[] = $query->equals($recordTypeParams['field'], $recordTypeParams['value']);
        }

        $query->matching($query->logicalAnd(...$constraints));
		return $query->execute();
	}


    /**
     * Get all used years grouped
     *
     * @param int $languageUid
     * @param array $settings
     * @return array
     * @throws \Doctrine\DBAL\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     */
    public function findAssignedYears(int $languageUid, array $settings): array
    {
        $fieldName = 'publish_date_year';
        $results = $this->findGroupedByField($fieldName, $this->getTableName(), 0, $languageUid, $settings, $fieldName);
        $years = [];
        foreach ($results as $result) {
            if ($year = $result[$fieldName]) {
                $years[$year] = $year;
            }
        }

        return $years;
    }


    /**
     * Find all products that have another filterable assigned
     *
     * @param int $languageUid
     * @param $settings
     * @return array
     * @throws \Doctrine\DBAL\Exception
     */
    public function findAssignedRelatedProducts(int $languageUid, $settings): array
    {
        $result = [];
        if ($fields = $this->getRelatedFieldNamesByRecordType((int) $settings['recordType'], true)) {
            foreach ($fields as $field) {
                $tempResult = $this->findGroupedByMMField($field, self::TABLE_FILTERABLE, 0, $languageUid, $settings);
                if ($tempResult) {
                    foreach ($tempResult as $row) {
                        $result[$row['l10n_parent'] ?: $row['uid']] = $row['title'];
                    }
                }
            }
        }

        return $result;
    }

}
