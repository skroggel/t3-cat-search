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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * Class FilterRepository
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FilterRepository extends AbstractRepository implements FilterRepositoryInterface
{

	/**
	 * @var array
	 */
	protected $defaultOrderings = [
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
	];


	/**
	 * @return void
	 */
	public function initializeObject(): void
	{
		/** @var \TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface $querySettings */
		$querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);

		// Show filters from all pages
		$querySettings->setRespectStoragePage(false);

		// we disable language filter here because filters are used with 'l10n_mode' => 'exclude',
		$querySettings->setRespectSysLanguage(false);

		$this->setDefaultQuerySettings($querySettings);
	}


	/**
	 * Find all filters that are used with Filterables
	 *
	 * @param int $languageUid
	 * @param int $typeUid
	 * @return array
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
	 * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
	 */
	public function findAllAssignedByLanguageAndType(int $languageUid = 0, int $typeUid = 0): array
	{
		$query = $this->createQuery();

		$localField = 'filterables';
		$constraints = [
			$query->logicalNot(
				$query->equals($localField . '.uid', null),
			),

			$query->equals($localField . '.hidden', 0),
			$query->equals($localField . '.deleted', 0),

			$query->logicalOr(
				$query->equals($localField . '.starttime', 0),
				$query->lessThanOrEqual($localField . '.starttime', time()),
			),

			$query->logicalOr(
				$query->equals($localField . '.endtime', 0),
				$query->greaterThanOrEqual($localField . '.endtime', time()),
			),
		];

		// check on language-level for 'l10n_mode' => 'exclude'
		$l10nMode = $GLOBALS['TCA'][$this->getTableName()]['columns'][$localField]['l10n_mode'] ?? '';
		if ($l10nMode == 'exclude') {
			$query->getQuerySettings()->setRespectSysLanguage(false);
			$constraints[] = $query->logicalOr(
				$query->equals($localField . '.sysLanguageUid',-1),
				$query->equals($localField . '.sysLanguageUid', $languageUid)
			);
		}

		if ($typeUid) {
			$constraints[] = $query->equals('type', $typeUid);
		}

		$query->matching($query->logicalAnd(...$constraints));
		$result = $query->execute();

		/** @var \Madj2k\CatSearch\Domain\Model\Filter $row */
		$finalResult = [];
		if ($result) {
			foreach ($result as $row) {
				$finalResult[$row->getUid()] = $row->getTitle();
			}
		}

		return $finalResult;
	}
}
