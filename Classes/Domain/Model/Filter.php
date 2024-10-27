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
 * Class Filter
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Filter extends AbstractEntity
{
	/**
	 * @var string
	 */
	protected string $title = '';


	/**
	 * @var \Madj2k\CatSearch\Domain\Model\FilterType|null
	 */
	protected ?FilterType $type = null;


	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable>|null
	 */
	protected ?ObjectStorage $filterables = null;


	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->filterables = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}


	/**
	 * Returns the title
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
	 * @param string $title
	 * @return void
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}


	/**
	 * Returns the filterType
	 *
	 * @return \Madj2k\CatSearch\Domain\Model\FilterType|null
	 */
	public function getType(): ?FilterType
	{
		return $this->type;
	}

	/**
	 * Sets the filterType
	 *
	 * @param \Madj2k\CatSearch\Domain\Model\FilterType $type
	 * @return void
	 */
	public function setType(FilterType $type): void
	{
		$this->type = $type;
	}


	/**
	 * Adds a filterable
	 *
	 * @param \Madj2k\CatSearch\Domain\Model\Filterable $filterable
	 * @return void
	 */
	public function addFilterable(Filterable $filterable): void
	{
		$this->filterables->attach($filterable);
	}


	/**
	 * Removes a filterable
	 *
	 * @param \Madj2k\CatSearch\Domain\Model\Filterable $filterable
	 * @return void
	 */
	public function removeFilterable(Filterable $filterable): void
	{
		$this->filterables->detach($filterable);
	}


	/**
	 * Returns the filterables
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $filterables
	 */
	public function getFilterables(): ObjectStorage
	{
		return $this->filterables;
	}


	/**
	 * Sets the filterables
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $filterables
	 * @return void
	 */
	public function setFilterables(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $filterables): void
	{
		$this->filterables = $filterables;
	}
}
