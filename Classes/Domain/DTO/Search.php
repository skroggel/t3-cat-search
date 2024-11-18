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

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
     * @var int
     */
    protected int $relatedProduct = 0;


    /**
     * @var int
     */
    protected int $filter1 = 0;


    /**
     * @var int
     */
    protected int $filter2 = 0;


    /**
     * @var int
     */
    protected int $filter3 = 0;


    /**
     * @var int
     */
    protected int $filter4 = 0;


    /**
     * @var int
     */
    protected int $filter5 = 0;


	/**
	 * @var array
	 */
	protected array $multiSelectFilter1 = [];


    /**
     * @var array
     */
    protected array $multiSelectFilter2 = [];


    /**
     * @var array
     */
    protected array $multiSelectFilter3 = [];


    /**
     * @var array
     */
    protected array $multiSelectFilter4 = [];


    /**
     * @var array
     */
    protected array $multiSelectFilter5 = [];


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
	 * @param int|null $year
	 * @return void
	 */
	public function setYear(?int $year): void
	{
		$this->year = (int) $year;
	}



    /**
     * Get relatedProduct
     *
     * @return int
     */
    public function getRelatedProduct(): int
    {
        return $this->relatedProduct;
    }


    /**
     * Set relatedProduct
     *
     * @param int|null $relatedProduct
     * @return void
     */
    public function setRelatedProduct(?int $relatedProduct): void
    {
        $this->relatedProduct = (int) $relatedProduct;
    }


    /**
     * Get filter
     *
     * @return int
     */
    public function getFilter1(): int
    {
        return $this->getFilter(1);
    }


    /**
     * Set filter
     *
     * @param int|null $filter
     * @return void
     */
    public function setFilter1(?int $filter): void
    {
        $this->setFilter(1, $filter);
    }


    /**
     * Get filter
     *
     * @return int
     */
    public function getFilter2(): int
    {
        return $this->getFilter(2);
    }


    /**
     * Set filter
     *
     * @param int|null $filter
     * @return void
     */
    public function setFilter2(?int $filter): void
    {
        $this->setFilter(2, $filter);
    }


    /**
     * Get filter
     *
     * @return int
     */
    public function getFilter3(): int
    {
        return $this->getFilter(3);
    }


    /**
     * Set filter
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
     * @return int
     */
    public function getFilter4(): int
    {
        return $this->getFilter(4);
    }


    /**
     * Set filter
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
     * @return int
     */
    public function getFilter5(): int
    {
        return $this->getFilter(5);
    }


    /**
     * Set filter
     *
     * @param int $filter
     * @return void
     */
    public function setFilter5(int $filter): void
    {
        $this->setFilter(5, $filter);
    }


    /**
	 * Get filter
	 *
	 * @return array
	 */
	public function getMultiSelectFilter1(): array
	{
		return $this->getMultiSelectFilter(1);
	}


	/**
	 * Set filters
	 *
	 * @param int[] $filter
	 * @return void
	 */
	public function setMultiSelectFilter1(array $filter): void
	{
        $this->setMultiSelectFilter(1, $filter);
	}


    /**
     * Get filter
     *
     * @return array
     */
    public function getMultiSelectFilter2(): array
    {
        return $this->getMultiSelectFilter(2);
    }


    /**
     * Set filters
     *
     * @param int[] $filter
     * @return void
     */
    public function setMultiSelectFilter2(array $filter): void
    {
        $this->setMultiSelectFilter(2, $filter);
    }


    /**
     * Get filter
     *
     * @return array
     */
    public function getMultiSelectFilter3(): array
    {
        return $this->getMultiSelectFilter(3);
    }


    /**
     * Set filters
     *
     * @param int[] $filter
     * @return void
     */
    public function setMultiSelectFilter3(array $filter): void
    {
        $this->setMultiSelectFilter(3, $filter);
    }


    /**
     * Get filter
     *
     * @return array
     */
    public function getMultiSelectFilter4(): array
    {
        return $this->getMultiSelectFilter(4);
    }


    /**
     * Set filters
     *
     * @param int[] $filter
     * @return void
     */
    public function setMultiSelectFilter4(array $filter): void
    {
        $this->setMultiSelectFilter(4, $filter);
    }


    /**
     * Get filter
     *
     * @return array
     */
    public function getMultiSelectFilter5(): array
    {
        return $this->getMultiSelectFilter(5);
    }


    /**
     * Set filters
     *
     * @param int[] $filter
     * @return void
     */
    public function setMultiSelectFilter5(array $filter): void
    {
        $this->setMultiSelectFilter(5, $filter);
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
		if (count($this->getAllFilters()) > 0 || $this->getTextQuery() || $this->getYear() ) {
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

		} else if ($property == '_filters') {
            foreach (range(1,5) as $number) {
                $this->unsetProperty('filter' . $number, $value);
                $this->unsetProperty('multiSelectFilter' . $number, $value);
            }
        }

		return false;
	}


    /**
     * Get all single filters
     *
     * @return array
     */
    public function getAllSingleFilters(): array
    {
        $allFilters = [];
        foreach (range(1,5) as $number) {
            $property = 'filter' . $number;
            if ($this->$property) {
                $allFilters[] = $this->$property;
            }
        }

        return $allFilters;
    }


    /**
     * @return array
     */
    public function getAllMultiSelectFilters(): array
    {
        $allFilters = [];
        foreach (range(1,5) as $number) {
            $property = 'multiSelectFilter' . $number;
            if ($this->$property) {
                $allFilters[] = $this->$property;
            }
        }
        return $allFilters;
    }


    /**
     * Get filters
     *
     * @return array
     */
    public function getAllFilters(): array
    {
        $allFilters = array_merge(
            $this->multiSelectFilter1,
            $this->multiSelectFilter2,
            $this->multiSelectFilter3,
            $this->multiSelectFilter4,
            $this->multiSelectFilter5
        );

        foreach (range(1,5) as $number) {
            $property = 'filter' . $number;
            if ($this->$property) {
                $allFilters[] = $this->$property;
            }
        }

        return $allFilters;
    }


    /**
     * Global getter for filters
     *
     * @param int $number
     * @return int
     */
    protected function getFilter (int $number): int
    {
        $property = 'filter' . $number;
        return $this->$property;
    }


    /**
     * Global setter for filter
     *
     * @param int $number
     * @param ?int $filter
     * @return void
    */
    protected function setFilter (int $number, ?int $filter): void
    {
        $property = 'filter' . $number;
        $this->$property = (int) $filter;
    }


    /**
     * Global getter for multiSelect-select filters
     *
     * @param int $number
     * @return array
     */
    protected function getMultiSelectFilter (int $number): array
    {
        $property = 'multiSelectFilter' . $number;
        return $this->$property;
    }


    /**
     * Global setter for multiSelect-select filters
     *
     * @param int $number
     * @param array $filter
     * @return void
     */
    protected function setMultiSelectFilter (int $number, array $filter): void
    {
        // we allow no zero-value here
        if (($key = array_search(0, $filter)) !== false) {
            unset($filter[$key]);
        }

        $property = 'multiSelectFilter' . $number;
        $this->$property = $filter;
    }

}
