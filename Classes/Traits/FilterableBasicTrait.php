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


use Madj2k\CatSearch\Domain\Model\Filter;
use Madj2k\CatSearch\Domain\Model\Filterable;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class FilterableBasicTrait
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
trait FilterableBasicTrait
{

    /**
     * @var int
     */
    protected int $recordType = 0;


    /**
     * @var string
     */
    protected string $layout = '';


    /**
     * @var int
     */
    protected int $publishDate = 0;


    /**
     * @var string
     */
    protected string $title = '';


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $relatedFilterables = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $relatedFilterableAccessories = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $relatedFilterableDocuments = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $relatedFilterableProducts = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $relatedFilterableProducts2 = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $filters = null;


    /**
     * @var \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    protected ?Filter $primaryFilter1 = null;


    /**
     * @var \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    protected ?Filter $primaryFilter2 = null;


    /**
     * @var \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    protected ?Filter $primaryFilter3 = null;


    /**
     * @var \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    protected ?Filter $primaryFilter4 = null;


    /**
     * @var \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    protected ?Filter $primaryFilter5 = null;


    /**
     * @var string
     */
    protected string $contentIndex = '';


    /**
	 * __construct
	 */
	public function __construct()
	{
		$this->filters = $this->filters ?? new ObjectStorage();
        $this->relatedFilterables = $this->relatedFilterables ?? new ObjectStorage();
        $this->relatedFilterableDocuments = $this->relatedFilterableDocuments ?? new ObjectStorage();
        $this->relatedFilterableAccessories = $this->relatedFilterableAccessories ?? new ObjectStorage();
        $this->relatedFilterableProducts = $this->relatedFilterableProducts ?? new ObjectStorage();
        $this->relatedFilterableProducts2 = $this->relatedFilterableProducts2 ?? new ObjectStorage();
    }


    /**
     * Returns the recordType
     *
     * @return int
     */
    public function getRecordType(): int
    {
        return $this->recordType;
    }


    /**
     * Sets the recordType
     *
     * @param int $recordType
     * @return void
     */
    public function setRecordType(int $recordType): void
    {
        $this->recordType = $recordType;
    }


    /**
     * Returns the layout
     *
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }


    /**
     * Sets the layout
     *
     * @param string $layout
     * @return void
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }


    /**
     * Returns the publishDate
     *
     * @return int
     */
    public function getPublishDate(): int
    {
        return $this->publishDate;
    }


    /**
     * Sets the publishDate
     *
     * @param int $publishDate
     * @return void
     */
    public function setPublishDate(int $publishDate): void
    {
        $this->publishDate = $publishDate;
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
     * Adds a relatedFilterable
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable $relatedFilterable
     * @return void
     */
    public function addRelatedFilterable(Filterable $relatedFilterable): void
    {
        $this->relatedFilterables->attach($relatedFilterable);
    }


    /**
     * Removes a relatedFilterable
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable $relatedFilterable
     * @return void
     */
    public function removeRelatedFilterable(Filterable $relatedFilterable): void
    {
        $this->relatedFilterables->detach($relatedFilterable);
    }


    /**
     * Returns the relatedFilterables
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $relatedFilterables
     */
    public function getRelatedFilterables(): ObjectStorage
    {
        if ($this->relatedFilterables instanceof LazyLoadingProxy) {
            $this->relatedFilterables->_loadRealInstance();
        }

        if ($this->relatedFilterables instanceof ObjectStorage) {
            return $this->relatedFilterables;
        }

        return $this->relatedFilterables = new ObjectStorage();
    }


    /**
     * Sets the relatedFilterables
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $relatedFilterables
     * @return void
     */
    public function setRelatedFilterables(ObjectStorage $relatedFilterables): void
    {
        $this->relatedFilterables = $relatedFilterables;
    }


    /**
     * Adds a relatedFilterableDocument
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable $relatedFilterableDocument
     * @return void
     */
    public function addRelatedFilterableDocument(Filterable $relatedFilterableDocument): void
    {
        $this->relatedFilterableDocuments->attach($relatedFilterableDocument);
    }


    /**
     * Removes a relatedFilterableDocument
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable $relatedFilterableDocument
     * @return void
     */
    public function removeRelatedFilterableDocument(Filterable $relatedFilterableDocument): void
    {
        $this->relatedFilterableDocuments->detach($relatedFilterableDocument);
    }


    /**
     * Returns the relatedFilterableDocuments
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $relatedFilterableDocuments
     */
    public function getRelatedFilterableDocuments(): ObjectStorage
    {
        if ($this->relatedFilterableDocuments instanceof LazyLoadingProxy) {
            $this->relatedFilterableDocuments->_loadRealInstance();
        }

        if ($this->relatedFilterableDocuments instanceof ObjectStorage) {
            return $this->relatedFilterableDocuments;
        }

        return $this->relatedFilterableDocuments = new ObjectStorage();
    }


    /**
     * Sets the relatedFilterableDocuments
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $relatedFilterableDocuments
     * @return void
     */
    public function setRelatedFilterableDocumentDocuments(ObjectStorage $relatedFilterableDocuments): void
    {
        $this->relatedFilterableDocuments = $relatedFilterableDocuments;
    }



    /**
     * Adds a relatedFilterableAccessory
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable $relatedFilterableAccessory
     * @return void
     */
    public function addRelatedFilterableAccessory(Filterable $relatedFilterableAccessory): void
    {
        $this->relatedFilterableAccessories->attach($relatedFilterableAccessory);
    }


    /**
     * Removes a relatedFilterableAccessory
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable $relatedFilterableAccessory
     * @return void
     */
    public function removeRelatedFilterableAccessory(Filterable $relatedFilterableAccessory): void
    {
        $this->relatedFilterableAccessories->detach($relatedFilterableAccessory);
    }


    /**
     * Returns the relatedFilterableAccessories
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $relatedFilterableAccessorys
     */
    public function getRelatedFilterableAccessories(): ObjectStorage
    {
        if ($this->relatedFilterableAccessories instanceof LazyLoadingProxy) {
            $this->relatedFilterableAccessories->_loadRealInstance();
        }

        if ($this->relatedFilterableAccessories instanceof ObjectStorage) {
            return $this->relatedFilterableAccessories;
        }

        return $this->relatedFilterableAccessories = new ObjectStorage();
    }


    /**
     * Sets the relatedFilterableAccessories
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $relatedFilterableAccessories
     * @return void
     */
    public function setRelatedFilterableAccessories(ObjectStorage $relatedFilterableAccessories): void
    {
        $this->relatedFilterableAccessories = $relatedFilterableAccessories;
    }


    /**
     * Adds a relatedFilterableProduct
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable $relatedFilterableProduct
     * @return void
     */
    public function addRelatedFilterableProduct(Filterable $relatedFilterableProduct): void
    {
        $this->relatedFilterableProducts->attach($relatedFilterableProduct);
    }


    /**
     * Removes a relatedFilterableProduct
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable $relatedFilterableProduct
     * @return void
     */
    public function removeRelatedFilterableProduct(Filterable $relatedFilterableProduct): void
    {
        $this->relatedFilterableProducts->detach($relatedFilterableProduct);
    }


    /**
     * Returns the relatedFilterableProducts
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $relatedFilterableProducts
     */
    public function getRelatedFilterableProducts(): ObjectStorage
    {
        if ($this->relatedFilterableProducts instanceof LazyLoadingProxy) {
            $this->relatedFilterableProducts->_loadRealInstance();
        }

        if ($this->relatedFilterableProducts instanceof ObjectStorage) {
            return $this->relatedFilterableProducts;
        }

        return $this->relatedFilterableProducts = new ObjectStorage();
    }


    /**
     * Sets the relatedFilterableProducts
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $relatedFilterableProducts
     * @return void
     */
    public function setRelatedFilterableProducts(ObjectStorage $relatedFilterableProducts): void
    {
        $this->relatedFilterableProducts = $relatedFilterableProducts;
    }


    /**
     * Adds a relatedFilterableProduct2
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable $relatedFilterableProduct2
     * @return void
     */
    public function addRelatedFilterableProduct2(Filterable $relatedFilterableProduct2): void
    {
        $this->relatedFilterableProducts2->attach($relatedFilterableProduct2);
    }


    /**
     * Removes a relatedFilterableProduct2
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable $relatedFilterableProduct2
     * @return void
     */
    public function removeRelatedFilterableProduct2(Filterable $relatedFilterableProduct2): void
    {
        $this->relatedFilterableProducts2->detach($relatedFilterableProduct2);
    }


    /**
     * Returns the relatedFilterableProducts2
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $relatedFilterableProducts2
     */
    public function getRelatedFilterableProducts2(): ObjectStorage
    {
        if ($this->relatedFilterableProducts2 instanceof LazyLoadingProxy) {
            $this->relatedFilterableProducts2->_loadRealInstance();
        }

        if ($this->relatedFilterableProducts2 instanceof ObjectStorage) {
            return $this->relatedFilterableProducts2;
        }

        return $this->relatedFilterableProducts2 = new ObjectStorage();
    }


    /**
     * Sets the relatedFilterableProducts2
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $relatedFilterableProducts2
     * @return void
     */
    public function setRelatedFilterableProducts2(ObjectStorage $relatedFilterableProducts2): void
    {
        $this->relatedFilterableProducts2 = $relatedFilterableProducts2;
    }


    /**
     * Sets the filters
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter> $filters
     * @return void
     */
    public function setFilters(ObjectStorage $filters): void
    {
        $this->filters = $filters;
    }


    /**
     * Adds a filter
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $filter
     * @return void
     */
    public function addFilter(Filter $filter): void
    {
        $this->filters->attach($filter);
    }


    /**
     * Removes a filter
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $filter
     * @return void
     */
    public function removeFilter(Filter $filter): void
    {
        $this->filters->detach($filter);
    }


    /**
     * Returns the filters
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter> $filters
     */
    public function getFilters(): ObjectStorage
    {
        if ($this->filters instanceof LazyLoadingProxy) {
            $this->filters->_loadRealInstance();
        }

        if ($this->filters instanceof ObjectStorage) {
            return $this->filters;
        }

        return $this->filters = new ObjectStorage();
    }


    /**
     * Returns the primaryFilter1
     *
     * @return \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    public function getPrimaryFilter1(): ?Filter
    {
        return $this->primaryFilter1;
    }


    /**
     * Sets the primaryFilter1
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $primaryFilter1
     * @return void
     */
    public function setPrimaryFilter1(Filter $primaryFilter1): void
    {
        $this->primaryFilter1 = $primaryFilter1;
    }


    /**
     * Returns the primaryFilter2
     *
     * @return \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    public function getPrimaryFilter2(): ?Filter
    {
        return $this->primaryFilter2;
    }


    /**
     * Sets the primaryFilter2
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $primaryFilter2
     * @return void
     */
    public function setPrimaryFilter2(Filter $primaryFilter2): void
    {
        $this->primaryFilter2 = $primaryFilter2;
    }


    /**
     * Returns the primaryFilter3
     *
     * @return \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    public function getPrimaryFilter3(): ?Filter
    {
        return $this->primaryFilter3;
    }


    /**
     * Sets the primaryFilter3
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $primaryFilter3
     * @return void
     */
    public function setPrimaryFilter3(Filter $primaryFilter3): void
    {
        $this->primaryFilter3 = $primaryFilter3;
    }


    /**
     * Returns the primaryFilter4
     *
     * @return \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    public function getPrimaryFilter4(): ?Filter
    {
        return $this->primaryFilter4;
    }


    /**
     * Sets the primaryFilter4
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $primaryFilter4
     * @return void
     */
    public function setPrimaryFilter4(Filter $primaryFilter4): void
    {
        $this->primaryFilter4 = $primaryFilter4;
    }


    /**
     * Returns the primaryFilter5
     *
     * @return \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    public function getPrimaryFilter5(): ?Filter
    {
        return $this->primaryFilter5;
    }


    /**
     * Sets the primaryFilter5
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $primaryFilter5
     * @return void
     */
    public function setPrimaryFilter5(Filter $primaryFilter5): void
    {
        $this->primaryFilter5 = $primaryFilter5;
    }


    /**
     * Returns full list of all filters
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter> $filters
     */
    public function getAllFilters(): ObjectStorage
    {
        $filters = $this->getFilters();
        foreach (range(1,5) as $cnt) {
            $getter = 'getPrimaryFilter' . $cnt;
            if ($this->$getter()) {
                $filters->attach($this->$getter());
            }
        }

        return $filters;
    }


	/**
	 * Returns a comma-separated list of all filters set
	 *
	 * @return string
	 */
	public function getAllFiltersList(): string
	{
		/** @var \Madj2k\CatSearch\Domain\Model\Filter $filter */
		$filtersList = [];
		foreach ($this->getAllFilters() as $filter) {
			$filtersList[] = $filter->getTitle();
		}
		return implode(', ', $filtersList);
	}


    /**
     * Returns the contentIndex
     *
     * @return string
     */
    public function getContentIndex(): string
    {
        return $this->contentIndex;
    }

}
