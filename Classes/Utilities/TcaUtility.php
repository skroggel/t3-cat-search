<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\Utilities;

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
 * Class TcaUtility
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Steffen Kroggel <developer@steffenkroggel.de>
 *  @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class TcaUtility
{

    /**
     * Gets primaryFilter by given number from extConf
     *
     * @param int $filterNumber
     * @return int
     */
	public static function getPrimaryFilterByExtConf(int $filterNumber): int
	{
        try {
            // check for primary filters
            $configReader = GeneralUtility::makeInstance(ExtensionConfiguration::class);
            $extensionConfig = $configReader->get('cat_search');

            if (!empty($extensionConfig['primaryFilterType' . $filterNumber])) {
                return (int) $extensionConfig['primaryFilterType' . $filterNumber];
            }

        } catch (\Exception $e) {
            // just ignore
        }

		return 0;
	}


    /**
     * Gets all primaryFilters by extConf
     *
     * @return array
     */
    public static function getPrimaryFiltersByExtConf(): array
    {
        $result = [];
        try {
            // check for primary filters
            $configReader = GeneralUtility::makeInstance(ExtensionConfiguration::class);
            $extensionConfig = $configReader->get('cat_search');

            foreach (range(1,5) as $filterNumber) {
                if (!empty($extensionConfig['primaryFilterType' . $filterNumber])) {
                    $result[$filterNumber] = $extensionConfig['primaryFilterType' . $filterNumber];
                }
            }

        } catch (\Exception $e) {
            // just ignore
        }

        return $result;
    }


    /**
     * Is a header in the plugin allowed via the extConf
     *
     * @param string $pluginName
     * @return bool
     */
    public static function isPluginHeaderAllowed(string $pluginName): bool {

        try {
            $configReader = GeneralUtility::makeInstance(ExtensionConfiguration::class);
            $extensionConfig = $configReader->get('cat_search');
            if (!empty($extensionConfig['pluginsWithHeader'])) {
                return in_array($pluginName, GeneralUtility::trimExplode(',', $extensionConfig['pluginsWithHeader'], true));
            }
        } catch (\Exception $e) {
            // do nothing
        }

        return false;
    }


    /**
     * Is a header in the plugin allowed via the extConf
     *
     * @param string $pluginName
     * @return bool
     */
    public static function hasPluginReducedFlexform(string $pluginName): bool {

        try {
            $configReader = GeneralUtility::makeInstance(ExtensionConfiguration::class);
            $extensionConfig = $configReader->get('cat_search');
            if (!empty($extensionConfig['pluginsWithReducedFlexform'])) {
                return in_array($pluginName, GeneralUtility::trimExplode(',', $extensionConfig['pluginsWithReducedFlexform'], true));
            }
        } catch (\Exception $e) {
            // do nothing
        }

        return false;
    }


    /**
     * Removed fields from TCA by extConf
     *
     * @param string $type
     * @param string $fields
     * @return string
     */
    public static function removeFieldsByExtConf(string $type, string $fields): string
    {
        try {

            $configReader = GeneralUtility::makeInstance(ExtensionConfiguration::class);
            $extensionConfig = $configReader->get('cat_search');

            if (!empty($extensionConfig['removeFields' . ucfirst($type)])) {
                $fieldsToRemoveArray = GeneralUtility::trimExplode(',', $extensionConfig['removeFields' .ucfirst($type)], true);
                $fieldsArray = GeneralUtility::trimExplode(',', $fields, true);
                foreach ($fieldsToRemoveArray as $fieldToRemove) {
                    if (($key = array_search($fieldToRemove, $fieldsArray)) !== false) {
                        unset($fieldsArray[$key]);
                    }
                }

                $fields = self::trimLinebreaks(implode(', ', $fieldsArray));
            }

        } catch (\Exception $e) {
            // just ignore
        }

        return $fields;
    }


    /**
     * Trim linebreaks from TCA
     *
     * @param $fields
     * @return string
     */
    public static function trimLinebreaks ($fields): string
    {
        // check if a linebreak is at start or end
        $prefix = '--linebreak--';
        if (substr($fields, 0, strlen($prefix)) == $prefix) {
            $fields = trim(trim(substr($fields, strlen($prefix))), ',');
        }
        if (substr($fields, strlen($fields) - strlen($prefix), strlen($fields)) == $prefix) {
            $fields = trim(trim(substr($fields, 0, strlen($prefix) * - 1)), ',');
        }

        return $fields;
    }

}
