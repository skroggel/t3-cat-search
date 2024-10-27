<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\Domain\DTO;

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
 * Class Search
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
final class Search
{

	/**
	 * @var string
	 */
	protected string $textQuery = '';


	/**
	 * @var int
	 */
	protected int $year = 0;


	/**
	 * @var array
	 */
	protected array $filters1 = [];


    /**
     * @var array
     */
    protected array $filters2 = [];


    /**
     * @var array
     */
    protected array $filters3 = [];


    /**
     * @var array
     */
    protected array $filters4 = [];


    /**
     * @var array
     */
    protected array $filters5 = [];


    /**
	 * @var string
	 */
	protected string $sorting = 'publish_date#desc';


	/**
	 * @var string
	 */
	protected string $layout = 'cards';


	/**
	 * @var int
	 */
	protected int $currentPage = 1;


	/**
	 * Get textQuery
	 *
	 * @return string
	 */
	public function getTextQuery(): string
	{
		return $this->textQuery;
	}


	/**
	 * Set textQuery
	 *
	 * @param string $textQuery
	 * @return void
	 */
	public function setTextQuery(string $textQuery): void
	{
		$this->textQuery = $textQuery;
	}


	/**
	 * Get year
	 *
	 * @return int
	 */
	public function getYear(): int
	{
		return $this->year;
	}


	/**
	 * Set year
	 *
	 * @param int $year
	 * @return void
	 */
	public function setYear(int $year): void
	{
		$this->year = $year;
	}


	/**
	 * Get filter
	 *
	 * @return array
	 */
	public function getFilters1(): array
	{
		return $this->getFilters(1);
	}


	/**
	 * Set filters
	 *
	 * @param int[] $filters
	 * @return void
	 */
	public function setFilters1(array $filters): void
	{
        $this->setFilters(1, $filters);
	}


	/**
	 * Set filter - for single select in multi-select context when coming from teaser-element
	 *
	 * @param int $filter
	 * @return void
	 */
	public function setFilter1(int $filter): void
	{
        $this->setFilter(1, $filter);
	}


    /**
     * Get filter
     *
     * @return array
     */
    public function getFilters2(): array
    {
        return $this->getFilters(2);
    }


    /**
     * Set filters
     *
     * @param int[] $filters
     * @return void
     */
    public function setFilters2(array $filters): void
    {
        $this->setFilters(2, $filters);
    }


    /**
     * Set filter - for single select in multi-select context when coming from teaser-element
     *
     * @param int $filter
     * @return void
     */
    public function setFilter2(int $filter): void
    {
        $this->setFilter(2, $filter);
    }


    /**
     * Get filter
     *
     * @return array
     */
    public function getFilters3(): array
    {
        return $this->getFilters(3);
    }


    /**
     * Set filters
     *
     * @param int[] $filters
     * @return void
     */
    public function setFilters3(array $filters): void
    {
        $this->setFilters(3, $filters);
    }


    /**
     * Set filter - for single select in multi-select context when coming from teaser-element
     *
     * @param int $filter
     * @return void
     */
    public function setFilter3(int $filter): void
    {
        $this->setFilter(3, $filter);
    }


    /**
     * Get filter
     *
     * @return array
     */
    public function getFilters4(): array
    {
        return $this->getFilters(4);
    }


    /**
     * Set filters
     *
     * @param int[] $filters
     * @return void
     */
    public function setFilters4(array $filters): void
    {
        $this->setFilters(4, $filters);
    }


    /**
     * Set filter - for single select in multi-select context when coming from teaser-element
     *
     * @param int $filter
     * @return void
     */
    public function setFilter4(int $filter): void
    {
        $this->setFilter(4, $filter);
    }


    /**
     * Get filter
     *
     * @return array
     */
    public function getFilters5(): array
    {
        return $this->getFilters(5);
    }


    /**
     * Set filters
     *
     * @param int[] $filters
     * @return void
     */
    public function setFilters5(array $filters): void
    {
        $this->setFilters(5, $filters);
    }


    /**
     * Set filter - for single select in multi-select context when coming from teaser-element
     *
     * @param int $filter
     * @return void
     */
    public function setFilter5(int $filter): void
    {
        $this->setFilter(5, $filter);
    }


    /**
     * Get filters
     *
     * @return array
     */
    public function getAllFilters(): array
    {
        return array_merge($this->filters1, $this->filters2, $this->filters3, $this->filters4, $this->filters5);
    }


    /**
	 * Get sorting
	 *
	 * @return string
	 */
	public function getSorting(): string
	{
		return $this->sorting;
	}


	/**
	 * Set sorting
	 *
	 * @param string $sorting
	 * @return void
	 */
	public function setSorting(string $sorting): void
	{
		$this->sorting = strtolower($sorting);
	}


	/**
	 * Get layout
	 *
	 * @return string
	 */
	public function getLayout(): string
	{
		return $this->layout;
	}


	/**
	 * Set layout
	 *
	 * @param string $layout
	 * @return void
	 */
	public function setLayout(string $layout): void
	{
		$this->layout = strtolower($layout);
	}


	/**
	 * Get currentPage
	 *
	 * @return int
	 */
	public function getCurrentPage(): int
	{
		return $this->currentPage;
	}


	/**
	 * Set currentPage
	 *
	 * @param int $currentPage
	 * @return void
	 */
	public function setCurrentPage(int $currentPage): void
	{
		$this->currentPage = $currentPage;
	}


	/**
	 * Is active
	 *
	 * @return bool
	 */
	public function getIsActive(): bool
	{
		if (count($this->getAllFilters()) > 1 || $this->getTextQuery() || $this->getYear() ) {
			return true;
		}

		return false;
	}


	/**
	 * Unset a given property
	 *
	 * @param string $property
	 * @param mixed $value
	 * @return bool
	 */
	public function unsetProperty(string $property, mixed $value = null): bool
	{
		if (property_exists($this::class, $property)) {
			if (is_array($this->$property) && $value) {
				if (($key = array_search($value, $this->$property)) !== false) {
					unset($this->$property[$key]);
					return true;
				}
			} else if (is_int($this->$property)) {
				$this->$property = 0;
				return true;

			} else if (is_bool($this->$property)) {
				$this->$property = false;
				return true;

			} else if (is_string($this->$property)) {
				$this->$property = '';
				return true;
			}
		}
		return false;
	}


    /**
     * Global getter for filters
     *
     * @param int $number
     * @return array
     */
    protected function getFilters (int $number): array
    {
        $property = 'filters' . $number;
        return $this->$property;
    }


    /**
     * Global setter for filters
     *
     * @param int $number
     * @param array $filters
     * @return void
     */
    protected function setFilters (int $number, array $filters): void
    {
        // we allow no zero-value here
        if (($key = array_search(0, $filters)) !== false) {
            unset($filters[$key]);
        }

        $property = 'filters' . $number;
        $this->$property = $filters;
    }


    /**
     * Global setter for filter
     *
     * @param int $number
     * @param int $filter
     * @return void
     */
    protected function setFilter (int $number, int $filter): void
    {
        $property = 'filters' . $number;
        $this->$property[] = $filter;
    }

}
