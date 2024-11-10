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

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;

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
    const string TABLE_FILTERABLE = 'tx_catsearch_domain_model_filterable';


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
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
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
}
