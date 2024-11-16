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

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class CTypeSelectItemProcFunc
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class CTypeSelectItemProcFunc
{
    /**
     * Add two items to existing ones
     *
     * @param array &$params
     * @
     * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException
     * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException
     */
    public function itemsProcFunc(array &$params): void
    {

        $configReader = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        $extensionConfig = $configReader->get('cat_search');

        $newList = [];
        if (
            (isset($extensionConfig['contentElementsAllowedCTypes']))
            && ($cTypeConfig = $extensionConfig['contentElementsAllowedCTypes'])
            && ($cTypes = GeneralUtility::trimExplode(';', $cTypeConfig, true))
        ) {

            foreach ($cTypes as $cType) {
                if ($config = GeneralUtility::trimExplode(',', $cType, true)) {
                    $newList[] = [
                        'value' => $config[0],
                        'label' => $config[1],
                    ];
                }
            }

            if ($newList) {
                $params['items'] = $newList;
            }
        }
    }
}
