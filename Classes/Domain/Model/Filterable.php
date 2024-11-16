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


use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class Filterable
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Filterable extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements FilterableInterface
{

    /**
     * @var int
     */
    protected int $recordType = 0;


    /**
     * @var string
     */
    protected string $subType = '';


    /**
     * @var string
     */
    protected string $layout = '';


    /**
     * @var int
     */
    protected int $detailPid = 0;


    /**
     * @var string
     */
    protected string $slug = '';


    /**
     * @var string
     */
    protected string $title = '';


    /**
     * @var string
     */
    protected string $titleSeo = '';

    /**
     * @var string
     */
    protected string $subtitle = '';


    /**
     * @var string
     */
    protected string $teaser = '';


    /**
     * @var string
     */
    protected string $description = '';

    /**
     * @var string
     */
    protected string $descriptionSeo = '';


    /**
     * @var int
     */
    protected int $publishDate = 0;


    /**
     * @var \Madj2k\CatSearch\Domain\Model\Manufacturer|null
     */
    protected ?Manufacturer $manufacturer = null;


    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $teaserImage = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $images = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $relatedFilterables = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $filters = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\TtContent>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $contentElements;


    /**
     * @var string
     */
    protected string $contentIndex = '';


    /**
	 * __construct
	 */
	public function __construct()
	{
		$this->filters = $this->filters ?? new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->images = $this->images ?? new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->relatedFilterables = $this->relatedFilterables ?? new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->contentElements = $this->contentElements ?? new ObjectStorage();
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
     * Returns the subType
     *
     * @return string
     */
    public function getSubType(): string
    {
        return $this->subType;
    }


    /**
     * Sets the subType
     *
     * @param string $subType
     * @return void
     */
    public function setSubType(string $subType): void
    {
        $this->subType = $subType;
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
     * Returns the detailPid
     *
     * @return int
     */
    public function getDetailPid(): int
    {
        return $this->detailPid;
    }


    /**
     * Sets the detailPid
     *
     * @param int $detailPid
     * @return void
     */
    public function setDetailPid(int $detailPid): void
    {
        $this->detailPid = $detailPid;
    }


    /**
     * Returns the slug
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }


    /**
     * Sets the slug
     *
     * @param string $slug
     * @return void
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
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
     * Returns the titleSeo
     *
     * @return string
     */
    public function getTitleSeo(): string
    {
        return $this->titleSeo;
    }


    /**
     * Sets the titleSeo
     *
     * @param string $titleSeo
     * @return void
     */
    public function setTitleSeo(string $titleSeo): void
    {
        $this->titleSeo = $titleSeo;
    }


    /**
     * Returns the teaser
     *
     * @return string
     */
    public function getTeaser(): string
    {
        return $this->teaser;
    }


    /**
     * Sets the teaser
     *
     * @param string $teaser
     * @return void
     */
    public function setTeaser(string $teaser): void
    {
        $this->teaser = $teaser;
    }


    /**
     * Returns the subtitle
     *
     * @return string
     */
    public function getSubtitle(): string
    {
        return $this->subtitle;
    }


    /**
     * Sets the subtitle
     *
     * @param string $subtitle
     * @return void
     */
    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }


    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    /**
     * Returns the descriptionSeo
     *
     * @return string
     */
    public function getDescriptionSeo(): string
    {
        return $this->descriptionSeo;
    }


    /**
     * Sets the descriptionSeo
     *
     * @param string $descriptionSeo
     * @return void
     */
    public function setDescriptionSeo(string $descriptionSeo): void
    {
        $this->descriptionSeo = $descriptionSeo;
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
     * Returns the manufacturer
     *
     * @return \Madj2k\CatSearch\Domain\Model\Manufacturer|null $manufacturer
     */
    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }


    /**
     * Sets the manufacturer
     *
     * @param \Madj2k\CatSearch\Domain\Model\Manufacturer $manufacturer
     * @return void
     */
    public function setManufacturer(Manufacturer $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }


    /**
     * Returns the teaserImage
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference|null $teaserImage
     */
    public function getTeaserImage(): ?FileReference
    {
        return $this->teaserImage;
    }


    /**
     * Sets the teaserImage
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $teaserImage
     * @return void
     */
    public function setTeaserImage(FileReference $teaserImage): void
    {
        $this->teaserImage = $teaserImage;
    }


    /**
     * Adds a image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image): void
    {
        $this->images->attach($image);
    }


    /**
     * Removes a image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image): void
    {
        $this->images->detach($image);
    }


    /**
     * Returns the images
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     */
    public function getImages(): ObjectStorage
    {
        if ($this->images instanceof LazyLoadingProxy) {
            $this->images->_loadRealInstance();
        }

        if ($this->images instanceof ObjectStorage) {
            return $this->images;
        }

        return $this->images = new ObjectStorage();
    }


    /**
     * Sets the images
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     * @return void
     */
    public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images): void
    {
        $this->images = $images;
    }


    /**
     * Adds a relatedFilterable
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterable
     * @return void
     */
    public function addRelatedFilterable(\TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterable): void
    {
        $this->relatedFilterables->attach($relatedFilterable);
    }


    /**
     * Removes a relatedFilterable
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterable
     * @return void
     */
    public function removeRelatedFilterable(\TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterable): void
    {
        $this->relatedFilterables->detach($relatedFilterable);
    }


    /**
     * Returns the relatedFilterables
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterables
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
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterables
     * @return void
     */
    public function setRelatedFilterables(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $relatedFilterables): void
    {
        $this->relatedFilterables = $relatedFilterables;
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
	 * Returns a comma-separated list of all filters set
	 *
	 * @return string
	 */
	public function getFiltersList(): string
	{
		/** @var \Madj2k\CatSearch\Domain\Model\Filter $filter */
		$filtersList = [];
		foreach ($this->filters as $filter) {
			$filtersList[] = $filter->getTitle();
		}
		return implode(', ', $filtersList);
	}


	/**
	 * Sets the filters
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter> $filters
	 * @return void
	 */
	public function setFilters(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $filters): void
	{
		$this->filters = $filters;
	}



    /**
     * Gets the contentElements
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\TtContent>
     */
    public function getContentElements(): \TYPO3\CMS\Extbase\Persistence\ObjectStorage
    {
        if ($this->contentElements instanceof LazyLoadingProxy) {
            $this->contentElements->_loadRealInstance();
        }

        if ($this->contentElements instanceof ObjectStorage) {
            return $this->contentElements;
        }

        return $this->contentElements = new ObjectStorage();
    }


    /**
     * Set the contentElements
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\TtContent> $contentElements
     * @return void
     */
    public function setContentElements(ObjectStorage $contentElements): void
    {
        $this->contentElements = $contentElements;
    }


    /**
     * Adds a contentElement to the record
     *
     * @param \Madj2k\CatSearch\Domain\Model\TtContent $contentElement
     * @return void
     */
    public function addContentElement(TtContent $contentElement): void
    {
        $this->contentElements->attach($contentElement);
    }


    /**
     * Get id list of contentElements
     *
     * @return string
     */
    public function getContentElementsIdList(): string
    {
        $idList = [];
        if ($contentElements = $this->getContentElements()) {
            foreach ($contentElements as $contentElement) {
                $idList[] = $contentElement->getUid();
            }
        }
        return implode(',', $idList);
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
