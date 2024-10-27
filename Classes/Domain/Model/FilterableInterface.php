<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\Domain\Model;

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


use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class FilterableInterface
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
interface FilterableInterface
{

    /**
     * Returns the publishDate
     *
     * @return int
     */
    public function getPublishDate(): int;


    /**
     * Sets the publishDate
     *
     * @param int $publishDate
     * @return void
     */
    public function setPublishDate(int $publishDate): void;


    /**
	 * Adds a filter
	 *
	 * @param \Madj2k\CatSearch\Domain\Model\Filter $filter
	 * @return void
	 */
	public function addFilter(Filter $filter): void;


	/**
	 * Removes a filter
	 *
	 * @param \Madj2k\CatSearch\Domain\Model\Filter $filter
	 * @return void
	 */
	public function removeFilter(Filter $filter): void;


	/**
	 * Returns the filters
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter> $filters
	 */
	public function getFilters(): ObjectStorage;


	/**
	 * Sets the filters
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter> $filters
	 * @return void
	 */
	public function setFilters(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $filters): void;

}
