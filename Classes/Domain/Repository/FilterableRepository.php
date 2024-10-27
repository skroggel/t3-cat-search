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
     * @var string
     */
    protected string $searchYearField = 'publish_date_year';


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

		// search for categories - but with "OR"
		if ($categories = $search->getAllFilters()) {
			$subConstraints = [];
			foreach ($categories as $category) {
				if($category != 0){
					$subConstraints[] = $query->contains('filters', $category);
				}
			}

			if (!empty($subConstraints)){
				$constraints[] = $query->logicalOr(...$subConstraints);
			}
		}

		// search for year
		if ($year = $search->getYear()) {
			$constraints[] = $query->equals($this->searchYearField, $year);
		}

		// search for string
		if ($textQuery = $search->getTextQuery()) {
			$constraints[] = $query->like('content_index', '%' . $textQuery .'%');
		}

		// Change sorting according to given values - check if given value is configured and the given field defined in TCA
		if (
			(in_array($search->getSorting(), GeneralUtility::trimExplode(',', $settings['sorting'] ?? '')))
			&& ($sorting = explode('#', strtolower($search->getSorting())))
			&& (count($sorting) == 2)
			&& ($GLOBALS['TCA'][$this->getTableName()]['columns'][$sorting[0]])
		){
			$orderDirection = QueryInterface::ORDER_ASCENDING;
			$orderColumn = $sorting[0];
			if ($sorting[1] == 'desc') {
				$orderDirection = QueryInterface::ORDER_DESCENDING;
			}

			$query->setOrderings([
					$orderColumn => $orderDirection
				]
			);
		}

		$query->matching($query->logicalAnd(...$constraints));
		return $query->execute();
	}


	/**
	 * Find all by given filter
	 *
	 * @param int $filter
	 * @param array $settings
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
	 */
	public function findByFilter(int $filter, array $settings): QueryResultInterface
	{

		$query = $this->createQuery();
		if ($limit = intval($settings[$settings['layout']]['limit'])) {
			$query->setLimit($limit);
		}

		$query->matching(
			$query->contains('filters', $filter)
		);

		return $query->execute();
	}


    /**
     * Get all used years grouped
     *
     * @param int $languageUid
     * @return array
     * @throws \Doctrine\DBAL\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     */
    public function findAllYearsAssigned(int $languageUid = 0): array
    {
        $tableName = $this->getTableName();

        /** @var \TYPO3\CMS\Core\Database\ConnectionPool $connectionPool */
        $connectionPool = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ConnectionPool::class);

        /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder */
        $queryBuilder = $connectionPool->getQueryBuilderForTable($tableName);

        $queryBuilder
            ->select($this->searchYearField)
            ->from($tableName)
            ->where (
                $queryBuilder->expr()->eq(
                    'sys_language_uid',
                    $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
                )
            )
            ->groupBy($this->searchYearField);

        $statement = $queryBuilder->executeQuery();
        $results = $statement->fetchAllAssociative();
        $years = [];
        foreach ($results as $result) {
            if ($year = $result[$this->searchYearField]) {
                $years[$year] = $year;
            }
        }

        return $years;
    }
}
