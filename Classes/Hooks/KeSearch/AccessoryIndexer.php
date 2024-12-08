<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\Hooks\KeSearch;

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

/**
 * Class AccessoryIndexer
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class AccessoryIndexer extends AbstractIndexer
{
    /**
     * @const string
     */
    const KEY = 'catsearch_accessory';


    /**
     * @const string
     */
    const RECORD_TYPE_STRING = 'accessory';


    /**
     * @const int
     */
    const RECORD_TYPE = 2;


}
