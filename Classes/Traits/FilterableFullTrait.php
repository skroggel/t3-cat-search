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
use Madj2k\CatSearch\Domain\Model\Manufacturer;
use Madj2k\CatSearch\Domain\Model\TtContent;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class FilterableFullTrait
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
trait FilterableFullTrait
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
    protected int $detailPid = 0;


    /**
     * @var int
     */
    protected int $overviewPid = 0;


    /**
     * @var string
     */
    protected string $slug = '';


    /**
     * @var int
     */
    protected int $publishDate = 0;


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
    protected string $header = '';


    /**
     * @var string
     */
    protected string $header2 = '';


    /**
     * @var string
     */
    protected string $header3 = '';


    /**
     * @var string
     */
    protected string $subheader = '';


    /**
     * @var string
     */
    protected string $subheader2 = '';


    /**
     * @var string
     */
    protected string $subheader3 = '';


    /**
     * @var string
     */
    protected string $description = '';


    /**
     * @var string
     */
    protected string $descriptionSeo = '';


    /**
     * @var string
     */
    protected string $description2 = '';


    /**
     * @var string
     */
    protected string $description3 = '';


    /**
     * @var string
     */
    protected string $productNumber = '';


    /**
     * @var string
     */
    protected string $features = '';


    /**
     * @var string
     */
    protected string $options = '';


    /**
     * @var string
     */
    protected string $applications = '';


    /**
     * @var string
     */
    protected string $highlights = '';


    /**
     * @var string
     */
    protected string $details = '';


    /**
     * @var \Madj2k\CatSearch\Domain\Model\Manufacturer|null
     */
    protected ?Manufacturer $manufacturer = null;


    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $teaserImage = null;


    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $mainImage = null;


    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $detailImage = null;


    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $download = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $images = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $downloads = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $dataSheets = null;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $mediaFiles = null;


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
		$this->filters = $this->filters ?? new ObjectStorage();
        $this->images = $this->images ?? new ObjectStorage();
        $this->downloads = $this->downloads ?? new ObjectStorage();
        $this->dataSheets = $this->dataSheets ?? new ObjectStorage();
        $this->mediaFiles = $this->mediaFiles ?? new ObjectStorage();
        $this->relatedFilterables = $this->relatedFilterables ?? new ObjectStorage();
        $this->relatedFilterableDocuments = $this->relatedFilterableDocuments ?? new ObjectStorage();
        $this->relatedFilterableAccessories = $this->relatedFilterableAccessories ?? new ObjectStorage();
        $this->relatedFilterableProducts = $this->relatedFilterableProducts ?? new ObjectStorage();
        $this->relatedFilterableProducts2 = $this->relatedFilterableProducts2 ?? new ObjectStorage();
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
     * Returns the overviewPid
     *
     * @return int
     */
    public function getOverviewPid(): int
    {
        return $this->overviewPid;
    }


    /**
     * Sets the overviewPid
     *
     * @param int $overviewPid
     * @return void
     */
    public function setOverviewPid(int $overviewPid): void
    {
        $this->overviewPid = $overviewPid;
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
     * Returns the header
     *
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }


    /**
     * Sets the header
     *
     * @param string $header
     * @return void
     */
    public function setHeader(string $header): void
    {
        $this->header = $header;
    }


    /**
     * Returns the header2
     *
     * @return string
     */
    public function getHeader2(): string
    {
        return $this->header2;
    }


    /**
     * Sets the header2
     *
     * @param string $header2
     * @return void
     */
    public function setHeader2(string $header2): void
    {
        $this->header2 = $header2;
    }


    /**
     * Returns the header3
     *
     * @return string
     */
    public function getHeader3(): string
    {
        return $this->header3;
    }


    /**
     * Sets the header3
     *
     * @param string $header3
     * @return void
     */
    public function setHeader3(string $header3): void
    {
        $this->header3 = $header3;
    }


    /**
     * Returns the subheader
     *
     * @return string
     */
    public function getSubheader(): string
    {
        return $this->subheader;
    }


    /**
     * Sets the subheader
     *
     * @param string $subheader
     * @return void
     */
    public function setSubheader(string $subheader): void
    {
        $this->subheader = $subheader;
    }


    /**
     * Returns the subheader2
     *
     * @return string
     */
    public function getSubheader2(): string
    {
        return $this->subheader2;
    }


    /**
     * Sets the subheader2
     *
     * @param string $subheader2
     * @return void
     */
    public function setSubheader2(string $subheader2): void
    {
        $this->subheader2 = $subheader2;
    }


    /**
     * Returns the subheader3
     *
     * @return string
     */
    public function getSubheader3(): string
    {
        return $this->subheader3;
    }


    /**
     * Sets the subheader3
     *
     * @param string $subheader3
     * @return void
     */
    public function setSubheader3(string $subheader3): void
    {
        $this->subheader3 = $subheader3;
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


    /**w
     * Returns the description2
     *
     * @return string
     */
    public function getDescription2(): string
    {
        return $this->description2;
    }


    /**
     * Sets the description2
     *
     * @param string $description2
     * @return void
     */
    public function setDescription2(string $description2): void
    {
        $this->description2 = $description2;
    }



    /**
     * Returns the description3
     *
     * @return string
     */
    public function getDescription3(): string
    {
        return $this->description3;
    }


    /**
     * Sets the description3
     *
     * @param string $description3
     * @return void
     */
    public function setDescription3(string $description3): void
    {
        $this->description3 = $description3;
    }



    /**
     * Returns the productNumber
     *
     * @return string
     */
    public function getProductNumber(): string
    {
        return $this->productNumber;
    }


    /**
     * Sets the productNumber
     *
     * @param string $productNumber
     * @return void
     */
    public function setProductNumber(string $productNumber): void
    {
        $this->productNumber = $productNumber;
    }


    /**
     * Returns the features
     *
     * @return string
     */
    public function getFeatures(): string
    {
        return $this->features;
    }


    /**
     * Sets the features
     *
     * @param string $features
     * @return void
     */
    public function setFeatures(string $features): void
    {
        $this->features = $features;
    }


    /**
     * Returns the options
     *
     * @return string
     */
    public function getOptions(): string
    {
        return $this->options;
    }


    /**
     * Sets the options
     *
     * @param string $options
     * @return void
     */
    public function setOptions(string $options): void
    {
        $this->options = $options;
    }


    /**
     * Returns the applications
     *
     * @return string
     */
    public function getApplications(): string
    {
        return $this->applications;
    }


    /**
     * Sets the applications
     *
     * @param string $applications
     * @return void
     */
    public function setApplications(string $applications): void
    {
        $this->applications = $applications;
    }


    /**
     * Returns the Highlights
     *
     * @return string
     */
    public function getHighlights(): string
    {
        return $this->highlights;
    }


    /**
     * Sets the Highlights
     *
     * @param string $highlights
     * @return void
     */
    public function setHighlights(string $highlights): void
    {
        $this->highlights = $highlights;
    }


    /**
     * Returns the details
     *
     * @return string
     */
    public function getDetails(): string
    {
        return $this->details;
    }


    /**
     * Sets the details
     *
     * @param string $details
     * @return void
     */
    public function setDetails(string $details): void
    {
        $this->details = $details;
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
     * Returns the mainImage
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference|null $mainImage
     */
    public function getMainImage(): ?FileReference
    {
        return $this->mainImage;
    }


    /**
     * Sets the mainImage
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $mainImage
     * @return void
     */
    public function setMainImage(FileReference $mainImage): void
    {
        $this->mainImage = $mainImage;
    }


    /**
     * Returns the detailImage
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference|null $detailImage
     */
    public function getDetailImage(): ?FileReference
    {
        return $this->detailImage;
    }


    /**
     * Sets the detailImage
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $detailImage
     * @return void
     */
    public function setDetailImage(FileReference $detailImage): void
    {
        $this->detailImage = $detailImage;
    }


    /**
     * Returns the download
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference|null $downloads
     */
    public function getDownload(): ?FileReference
    {
        return $this->download;
    }


    /**
     * Sets the download
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $download
     * @return void
     */
    public function setDownload(FileReference $download): void
    {
        $this->download = $download;
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
    public function setImages(ObjectStorage $images): void
    {
        $this->images = $images;
    }


    /**
     * Adds a download
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $download
     * @return void
     */
    public function addDownload(\TYPO3\CMS\Extbase\Domain\Model\FileReference $download): void
    {
        $this->downloads->attach($download);
    }


    /**
     * Removes a download
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $download
     * @return void
     */
    public function removeDownload(\TYPO3\CMS\Extbase\Domain\Model\FileReference $download): void
    {
        $this->downloads->detach($download);
    }


    /**
     * Returns the downloads
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $downloads
     */
    public function getDownloads(): ObjectStorage
    {
        if ($this->downloads instanceof LazyLoadingProxy) {
            $this->downloads->_loadRealInstance();
        }

        if ($this->downloads instanceof ObjectStorage) {
            return $this->downloads;
        }

        return $this->downloads = new ObjectStorage();
    }


    /**
     * Sets the downloads
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $downloads
     * @return void
     */
    public function setDownloads(ObjectStorage $downloads): void
    {
        $this->downloads = $downloads;
    }


    /**
     * Adds a dataSheet
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $dataSheet
     * @return void
     */
    public function addDataSheet(\TYPO3\CMS\Extbase\Domain\Model\FileReference $dataSheet): void
    {
        $this->dataSheets->attach($dataSheet);
    }


    /**
     * Removes a dataSheet
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $dataSheet
     * @return void
     */
    public function removeDataSheet(\TYPO3\CMS\Extbase\Domain\Model\FileReference $dataSheet): void
    {
        $this->dataSheets->detach($dataSheet);
    }


    /**
     * Returns the dataSheets
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $dataSheets
     */
    public function getDataSheets(): ObjectStorage
    {
        if ($this->dataSheets instanceof LazyLoadingProxy) {
            $this->dataSheets->_loadRealInstance();
        }

        if ($this->dataSheets instanceof ObjectStorage) {
            return $this->dataSheets;
        }

        return $this->dataSheets = new ObjectStorage();
    }


    /**
     * Sets the dataSheets
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $dataSheets
     * @return void
     */
    public function setDataSheets(ObjectStorage $dataSheets): void
    {
        $this->dataSheets = $dataSheets;
    }


    /**
     * Adds a mediaFile
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $mediaFile
     * @return void
     */
    public function addMediaFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $mediaFile): void
    {
        $this->mediaFiles->attach($mediaFile);
    }


    /**
     * Removes a mediaFile
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $mediaFile
     * @return void
     */
    public function removeMediaFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $mediaFile): void
    {
        $this->mediaFiles->detach($mediaFile);
    }


    /**
     * Returns the mediaFiles
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $mediaFiles
     */
    public function getMediaFiles(): ObjectStorage
    {
        if ($this->mediaFiles instanceof LazyLoadingProxy) {
            $this->mediaFiles->_loadRealInstance();
        }

        if ($this->mediaFiles instanceof ObjectStorage) {
            return $this->mediaFiles;
        }

        return $this->mediaFiles = new ObjectStorage();
    }


    /**
     * Sets the mediaFiles
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $mediaFiles
     * @return void
     */
    public function setMediaFiles(ObjectStorage $mediaFiles): void
    {
        $this->mediaFiles = $mediaFiles;
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
     * Gets the contentElements
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\TtContent>
     */
    public function getContentElements(): ObjectStorage
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
