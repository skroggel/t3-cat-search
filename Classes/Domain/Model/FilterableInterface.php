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
     * Returns the recordType
     *
     * @return int
     */
    public function getRecordType(): int;


    /**
     * Returns the layout
     *
     * @return string
     */
    public function getLayout(): string;


    /**
     * Returns the publishDate
     *
     * @return int
     */
    public function getPublishDate(): int;


    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle(): string;


    /**
     * Returns the relatedFilterables
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterables
     */
    public function getRelatedFilterables(): ObjectStorage;



    /**
     * Returns the relatedFilterableDocuments
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterableDocuments
     */
    public function getRelatedFilterableDocuments(): ObjectStorage;



    /**
     * Returns the relatedFilterableAccessories
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterableAccessorys
     */
    public function getRelatedFilterableAccessories(): ObjectStorage;


    /**
     * Returns the relatedFilterableProducts
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterableProducts
     */
    public function getRelatedFilterableProducts(): ObjectStorage;


    /**
     * Returns the relatedFilterableProducts2
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $relatedFilterableProducts2
     */
    public function getRelatedFilterableProducts2(): ObjectStorage;


    /**
     * Returns the filters
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter> $filters
     */
    public function getFilters(): ObjectStorage;


    /**
     * Returns the primaryFilter1
     *
     * @return \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    public function getPrimaryFilter1(): ?Filter;


    /**
     * Sets the primaryFilter1
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $primaryFilter1
     * @return void
     */
    public function setPrimaryFilter1(Filter $primaryFilter1): void;


    /**
     * Returns the primaryFilter2
     *
     * @return \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    public function getPrimaryFilter2(): ?Filter;


    /**
     * Sets the primaryFilter2
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $primaryFilter2
     * @return void
     */
    public function setPrimaryFilter2(Filter $primaryFilter2): void;


    /**
     * Returns the primaryFilter3
     *
     * @return \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    public function getPrimaryFilter3(): ?Filter;


    /**
     * Sets the primaryFilter3
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $primaryFilter3
     * @return void
     */
    public function setPrimaryFilter3(Filter $primaryFilter3): void;


    /**
     * Returns the primaryFilter4
     *
     * @return \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    public function getPrimaryFilter4(): ?Filter;


    /**
     * Sets the primaryFilter4
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $primaryFilter4
     * @return void
     */
    public function setPrimaryFilter4(Filter $primaryFilter4): void;


    /**
     * Returns the primaryFilter5
     *
     * @return \Madj2k\CatSearch\Domain\Model\Filter|null
     */
    public function getPrimaryFilter5(): ?Filter;


    /**
     * Sets the primaryFilter5
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filter $primaryFilter5
     * @return void
     */
    public function setPrimaryFilter5(Filter $primaryFilter5): void;


    /**
     * Returns full list of all filters
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filter> $filters
     */
    public function getAllFilters(): ObjectStorage;


    /**
     * Returns a comma-separated list of all filters set
     *
     * @return string
     */
    public function getAllFiltersList(): string;

}

