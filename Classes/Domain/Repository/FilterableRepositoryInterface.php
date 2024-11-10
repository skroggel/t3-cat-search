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
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * Class ItemRepositoryInterface
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
interface FilterableRepositoryInterface
{

    /**
     * Find all by given search-object
     *
     * @param \Madj2k\CatSearch\Domain\DTO\Search $search
     * @param array $settings
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     */
    public function findBySearch(Search $search, array $settings): QueryResultInterface;


    /**
     * Get all used years grouped
     *
     * @param int $languageUid
     * @param array $settings
     * @return array
     * @throws \Doctrine\DBAL\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     */
    public function findAllYearsAssigned(int $languageUid, array $settings): array;
}
