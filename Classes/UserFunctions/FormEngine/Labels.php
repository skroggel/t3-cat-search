<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\UserFunctions\FormEngine;

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

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class FilterTypeLabel
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Labels
{

    /**
     * @const string
     */
    const TABLE_FILTER_TYPE = 'tx_catsearch_domain_model_filtertype';


    /**
     * Filter label
     *
     * @param array &$params
     */
    public function labelFilterableTable(array &$params): void
    {
        if (isset($params['row']['uid'])) {
            $record = BackendUtility::getRecord(
                $params['table'],
                (int) $params['row']['uid'],
                'uid, title, subtitle, record_type'
            );

            $params['title'] = $record['title'];

            if (
                (isset($record['subtitle']))
                && ($record['subtitle'])
            ){
                $params['title'] .= ', ' . $record['subtitle'];
            }

            if (
                (isset($record['record_type']))
                && ($record['record_type'])
            ){

                $ll = 'LLL:EXT:cat_search/Resources/Private/Language/locallang_db.xlf:';
                $recordType = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(
                    $ll . 'tx_catsearch_domain_model_filterable.record_type.'. $record['record_type'],
                );

                if ($recordType) {
                    $params['title'] .= ' (' . $recordType . ')';
                }
            }
        }
    }


    /**
     * Filter label
     *
     * @param array &$params
     */
    public function labelFilterTable(array &$params): void
    {
        if (isset($params['row']['uid'])) {
            $record = BackendUtility::getRecord($params['table'], (int) $params['row']['uid'], 'uid, title, type');

            $params['title'] = $record['title'];

            if (isset($record['type'])) {
                $typeRecord = BackendUtility::getRecord( self::TABLE_FILTER_TYPE, (int) $record['type'], 'title');
                $params['title'] .= ', ' . $typeRecord['title'];
            }
        }
    }
}
