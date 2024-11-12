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

use TYPO3\CMS\Extbase\Domain\Model\File;
use \TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class FilterableDocument
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FilterableDocument extends Filterable
{

    /**
     * @var string
     */
    protected string $language = '';


    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $download = null;


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
        $this->relatedFilterableProducts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }


    /**
     * Returns the language
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }


    /**
     * Sets the language
     *
     * @param string $language
     * @return void
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
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
    public function setDownloads(FileReference $download): void
    {
        $this->download = $download;
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
