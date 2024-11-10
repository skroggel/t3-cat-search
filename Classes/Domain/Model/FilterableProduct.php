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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;


/**
 * Class FilterableProduct
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FilterableProduct extends Filterable
{

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
    protected string $subheader = '';


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
    protected string $features = '';


    /**
     * @var string
     */
    protected string $options = '';


    /**
     * @var string
     */
    protected string $details = '';



    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $mainImage = null;


    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>|null
     */
    protected ?ObjectStorage $downloads = null;


    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>|null
     */
    protected ?ObjectStorage $mediaFiles = null;


    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable>|null
     */
    protected ?ObjectStorage $relatedFilterableDocuments = null;


    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable>|null
     */
    protected ?ObjectStorage $relatedFilterableAccessories = null;


    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable>|null
     */
    protected ?ObjectStorage $relatedFilterableProducts = null;



    /**
     *
     * __construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->downloads = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->mediaFiles = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->relatedFilterableDocuments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->relatedFilterableAccessories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->relatedFilterableProducts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
        return $this->downloads;
    }


    /**
     * Sets the downloads
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $downloads
     * @return void
     */
    public function setDownloads(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $downloads): void
    {
        $this->downloads = $downloads;
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
        return $this->mediaFiles;
    }


    /**
     * Sets the mediaFiles
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $mediaFiles
     * @return void
     */
    public function setMediaFiles(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $mediaFiles): void
    {
        $this->mediaFiles = $mediaFiles;
    }


    /**
     * Adds a relatedFilterableDocument
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableDocument
     * @return void
     */
    public function addRelatedFilterableDocument(\TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableDocument): void
    {
        $this->relatedFilterableDocuments->attach($relatedFilterableDocument);
    }


    /**
     * Removes a relatedFilterableDocument
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableDocument
     * @return void
     */
    public function removeRelatedFilterableDocument(\TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableDocument): void
    {
        $this->relatedFilterableDocuments->detach($relatedFilterableDocument);
    }


    /**
     * Returns the relatedFilterableDocuments
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterableDocuments
     */
    public function getRelatedFilterableDocumentDocuments(): ObjectStorage
    {
        return $this->relatedFilterableDocuments;
    }


    /**
     * Sets the relatedFilterableDocuments
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterableDocuments
     * @return void
     */
    public function setRelatedFilterableDocumentDocuments(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $relatedFilterableDocuments): void
    {
        $this->relatedFilterableDocuments = $relatedFilterableDocuments;
    }



    /**
     * Adds a relatedFilterableAccessory
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableAccessory
     * @return void
     */
    public function addRelatedFilterableAccessory(\TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableAccessory): void
    {
        $this->relatedFilterableAccessories->attach($relatedFilterableAccessory);
    }


    /**
     * Removes a relatedFilterableAccessory
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableAccessory
     * @return void
     */
    public function removeRelatedFilterableAccessory(\TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableAccessory): void
    {
        $this->relatedFilterableAccessories->detach($relatedFilterableAccessory);
    }


    /**
     * Returns the relatedFilterableAccessories
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterableAccessorys
     */
    public function getRelatedFilterableAccessoryAccessories(): ObjectStorage
    {
        return $this->relatedFilterableAccessories;
    }


    /**
     * Sets the relatedFilterableAccessories
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterableAccessories
     * @return void
     */
    public function setRelatedFilterableAccessoryAccessories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $relatedFilterableAccessories): void
    {
        $this->relatedFilterableAccessories = $relatedFilterableAccessories;
    }


    /**
     * Adds a relatedFilterableProduct
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableProduct
     * @return void
     */
    public function addRelatedFilterableProduct(\TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableProduct): void
    {
        $this->relatedFilterableProducts->attach($relatedFilterableProduct);
    }


    /**
     * Removes a relatedFilterableProduct
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableProduct
     * @return void
     */
    public function removeRelatedFilterableProduct(\TYPO3\CMS\Extbase\Domain\Model\FileReference $relatedFilterableProduct): void
    {
        $this->relatedFilterableProducts->detach($relatedFilterableProduct);
    }


    /**
     * Returns the relatedFilterableProducts
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterableProducts
     */
    public function getRelatedFilterableProductProducts(): ObjectStorage
    {
        return $this->relatedFilterableProducts;
    }


    /**
     * Sets the relatedFilterableProducts
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterableProducts
     * @return void
     */
    public function setRelatedFilterableProductProducts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $relatedFilterableProducts): void
    {
        $this->relatedFilterableProducts = $relatedFilterableProducts;
    }


}
