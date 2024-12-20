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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class FilterType
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FilterType extends AbstractEntity
{
	/**
	 * @var string
	 */
	protected string $title = '';


    /**
     * @var string
     */
    protected string $titleLong = '';


    /**
     * @var bool
     */
    protected bool $isInternal = false;


	/**
	 * filters
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter>|null
	 */
	protected ?ObjectStorage $filters = null;


	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->filters = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}


	/**
	 * Gets the title
	 *
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}


	/**
	 * Sets the title
	 *
	 * @param string $title title
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}


    /**
     * Gets the titleLong
     *
     * @return string
     */
    public function getTitleLong(): string
    {
        return $this->titleLong;
    }


    /**
     * Sets the titleLong
     *
     * @param string $titleLong titleLong
     */
    public function setTitleLong(string $titleLong): void
    {
        $this->titleLong = $titleLong;
    }


    /**
     * Gets the combined title
     *
     * @return string
     */
    public function getTitleCombined(): string
    {
        return $this->titleLong ?: $this->title;
    }



    /**
     * Gets the isInternal
     *
     * @return bool
     */
    public function getIsInternal(): bool
    {
        return $this->isInternal;
    }


    /**
     * Sets the isInternal
     *
     * @param bool $isInternal isInternal
     */
    public function setIsInternal(bool $isInternal): void
    {
        $this->isInternal = $isInternal;
    }


	/**
	 * Adds a filter
	 *
	 * @param \Madj2k\CatSearch\Domain\Model\Filter $filter
	 */
	public function addFilter(Filter $filter): void
	{
		$this->filters->attach($filter);
	}


	/**
	 * Removes a filter
	 *
	 * @param \Madj2k\CatSearch\Domain\Model\Filter $filter
	 */
	public function removeFilter(Filter $filter)
	{
		$this->filters->detach($filter);
	}


	/**
	 * Returns the filters
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter>
	 */
	public function getFilters(): ObjectStorage
	{
		return $this->filters;
	}


	/**
	 * Sets the filters
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter> $filters
	 */
	public function setFilters(ObjectStorage $filters): void
	{
		$this->filters = $filters;
	}
}
