<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\Traits;

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

use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Class DebugTrait
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
trait DebugTrait
{

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface|\TYPO3\CMS\Core\Database\Query\QueryBuilder $query
     * @param string $file
     * @return string
     */
    protected static function debugQuery(QueryInterface|QueryBuilder $query, string $file = ''): string {

        $queryBuilder = $query;
        if ($query instanceof QueryInterface) {
            /** @var \TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser $typo3DbQueryParser */
            $typo3DbQueryParser = GeneralUtility::makeInstance(Typo3DbQueryParser::class);
            $queryBuilder = $typo3DbQueryParser->convertQueryToDoctrineQueryBuilder($query);
        }

        $querySql = $queryBuilder->getSQL();
        $queryParams = $queryBuilder->getParameters();

        // sort inverse in order to replace :dcValue11 before :dcValue1
        krsort($queryParams);

        foreach ($queryParams as $key => $value) {
            $querySql = str_replace(':' . $key, (string) $value, $querySql);
        }

        if ($file) {
            file_put_contents($file, $querySql . "\n", FILE_APPEND);
        }

        return $querySql;
    }
}
