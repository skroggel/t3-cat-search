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

use Madj2k\CatSearch\Traits\DebugTrait;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
     * @var string
     */
    protected string $filterableField = 'filterables';


    /**
	 * @var array
	 */
	protected $defaultOrderings = [
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	];


	/**
	 * @return void

	public function initializeObject(): void
	{
		/** @var \TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface $querySettings
		$querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);

		// Show filters from all pages
		$querySettings->setRespectStoragePage(false);

		// we disable language filter here because filters are used with 'l10n_mode' => 'exclude',
		$querySettings->setRespectSysLanguage(false);

		$this->setDefaultQuerySettings($querySettings);
	}
    */

    /**
     * Find all filters that are used with filterables
     *
     * @param int $languageUid
     * @param int $typeUid
     * @param $settings
     * @return array
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     * @throws \Doctrine\DBAL\Exception
     */
	public function findAssignedByLanguageAndType(int $languageUid, int $typeUid, $settings): array
	{
        // get filters from filters-field
        $result = $this->findGroupedByMMField(
            'filterables',
            $this->getTableName(),
            $typeUid,
            $languageUid,
            $settings
        );

        // primary-filters to this
        foreach (range(1,5) as $cnt) {
            $result += $this->findGroupedByField(
                'primary_filter' . $cnt,
                self::TABLE_FILTERABLE,
                $typeUid,
                $languageUid,
                $settings
            );
        }

        $finalResult = [];
        if ($result) {
            foreach ($result as $row) {
                $finalResult[$row['l10n_parent'] ?: $row['uid']] = $row['title'];
            }
        }

        return $finalResult;
	}
}
