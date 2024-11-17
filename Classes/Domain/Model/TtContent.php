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
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class TtContent
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class TtContent extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $CType = '';


    /**
     * @var string
     */
    protected string $header = '';


    /**
     * @var string
     */
    protected string $subheader = '';


    /**
     * @var string
     */
    protected string $headerLink = '';


    /**
     * @var string
     */
    protected string $headerLayout = '';


    /**
     * @var string
     */
    protected string $headerPosition = '';


    /**
     * @var string
     */
    protected string $bodytext = '';

    /**
     * @var int
     */
    protected $colPos = 0;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $image = null;


    /**
     * @var int
     */
    protected int $imagewidth = 0;


    /**
     * @var int
     */
    protected int $imageorient = 0;


    /**
     * @var string
     */
    protected string $imagecaption = '';


    /**
     * @var int
     */
    protected int $imagecols = 0;


    /**
     * @var int
     */
    protected int $imageborder = 0;


    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>|\TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|null
     */
    protected ObjectStorage|LazyLoadingProxy|null $media = null;


    /**
     * @var string
     */
    protected string $layout = '';


    /**
     * @var int
     */
    protected int $cols = 0;


    /**
     * @var string
     */
    protected string $imageLink = '';


    /**
     * @var string
     */
    protected string $imageZoom = '';


    /**
     * @var string
     */
    protected string $altText = '';


    /**
     * @var string
     */
    protected string $titleText = '';


    /**
     * @var string
     */
    protected string $listType = '';


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initializeObject();
    }

    /**
     * @return void
     */
    public function initializeObject(): void
    {
        $this->image = $this->image ?? new ObjectStorage();
        $this->media = $this->media ?? new ObjectStorage();
    }


    /**
     * Gets the cType
     *
     * @return string
     */
    public function getCType(): string
    {
        return $this->CType;
    }


    /**
     * Sets the cType
     *
     * @param string $ctype
     * @return void
     */
    public function setCType(string $ctype): void
    {
        $this->CType = $ctype;
    }


    /**
     * Get the header
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
     * Gets the subheader
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
     * Gets the headerLink
     *
     * @return string
     */
    public function getHeaderLink(): string
    {
        return $this->headerLink;
    }


    /**
     * Sets the headerLink
     *
     * @param string $headerLink
     * @return void
     */
    public function setHeaderLink(string $headerLink): void
    {
        $this->headerLink = $headerLink;
    }


    /**
     * Gets the headerPosition
     *
     * @return string
     */
    public function getHeaderPosition(): string
    {
        return $this->headerPosition;
    }


    /**
     * Sets the headerPosition
     *
     * @param string $headerPosition
     * @return void
     */
    public function setHeaderPosition(string $headerPosition): void
    {
        $this->headerPosition = $headerPosition;
    }


    /**
     * Gets the bodytext
     *
     * @return string
     */
    public function getBodytext(): string
    {
        return $this->bodytext;
    }


    /**
     * Sets the bodytext
     *
     * @param string $bodytext
     * @return void
     */
    public function setBodytext(string $bodytext): void
    {
        $this->bodytext = $bodytext;
    }


    /**
     * Get the colpos
     *
     * @return int
     */
    public function getColPos(): int
    {
        return $this->colPos;
    }


    /**
     * Set colpos
     *
     * @param int $colPos
     * @return void
     */
    public function setColPos(int $colPos): void
    {
        $this->colPos = $colPos;
    }


    /**
     * Gets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function addImage(FileReference $image): void
    {
        $this->image = $this->getImage();
        $this->image->attach($image);
    }


    /**
     * Gets the image
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getImage(): ObjectStorage
    {
        if ($this->image instanceof LazyLoadingProxy) {
            $this->image->_loadRealInstance();
        }

        if ($this->image instanceof ObjectStorage) {
            return $this->image;
        }

        return $this->image = new ObjectStorage();
    }


    /**
     * Removes the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function removeImage(FileReference $image): void
    {
        $this->image = $this->getImage();
        $this->image->detach($image);
    }


    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $image
     * @return void
     */
    public function setImage(ObjectStorage $image): void
    {
        $this->image = $image;
    }


    /**
     * Gets the imagewidth
     *
     * @return int
     */
    public function getImagewidth(): int
    {
        return $this->imagewidth;
    }


    /**
     * Sets the imagewidth
     *
     * @param int $imagewidth
     * @return void
     */
    public function setImagewidth(int $imagewidth): void
    {
        $this->imagewidth = $imagewidth;
    }


    /**
     * Gets the imageorient
     *
     * @return int
     */
    public function getImageorient(): int
    {
        return $this->imageorient;
    }


    /**
     * Sets the imageorient
     *
     * @param int $imageorient
     * @return void
     */
    public function setImageorient(int $imageorient): void
    {
        $this->imageorient = $imageorient;
    }


    /**
     * Gets the imagecaption
     *
     * @return string
     */
    public function getImagecaption(): string
    {
        return $this->imagecaption;
    }


    /**
     * Sets the imagecaption
     *
     * @param string $imagecaption
     * @return void
     */
    public function setImagecaption(string $imagecaption): void
    {
        $this->imagecaption = $imagecaption;
    }


    /**
     * Gets the imagecols
     *
     * @return int
     */
    public function getImagecols(): int
    {
        return $this->imagecols;
    }


    /**
     * Sets the imagecols
     *
     * @param int $imagecols
     * @return void
     */
    public function setImagecols(int $imagecols): void
    {
        $this->imagecols = $imagecols;
    }


    /**
     * Gets the imageborder
     *
     * @return int
     */
    public function getImageborder(): int
    {
        return $this->imageborder;
    }


    /**
     * Sets the imageborder
     *
     * @param int $imageborder
     */
    public function setImageborder(int $imageborder): void
    {
        $this->imageborder = $imageborder;
    }


    /**
     * Adds the media
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
     * @return void
     */
    public function addMedia(FileReference $media): void
    {
        $this->media = $this->getMedia();
        $this->media->attach($media);
    }


    /**
     * Gets the media
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getMedia(): ObjectStorage
    {
        if ($this->media instanceof LazyLoadingProxy) {
            $this->media->_loadRealInstance();
        }

        if ($this->media instanceof ObjectStorage) {
            return $this->media;
        }

        return $this->media = new ObjectStorage();
    }


    /**
     * Removed the media
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
     * @return void
     */
    public function removeMedia(FileReference $media): void
    {
        $this->media = $this->getMedia();
        $this->media->detach($media);
    }


    /**
     * Sets the media
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $media
     * @return void
     */
    public function setMedia(ObjectStorage $media): void
    {
        $this->media = $media;
    }


    /**
     * Gets the layout
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
     * Gets the cols
     *
     * @return int
     */
    public function getCols(): int
    {
        return $this->cols;
    }


    /**
     * Sets the cols
     *
     * @param int $cols
     * @return void
     */
    public function setCols(int $cols): void
    {
        $this->cols = $cols;
    }


    /**
     * Gets the imageLink
     *
     * @return string
     */
    public function getImageLink(): string
    {
        return $this->imageLink;
    }


    /**
     * Gets the imageLink
     *
     * @param string $imageLink
     * @return void
     */
    public function setImageLink(string $imageLink): void
    {
        $this->imageLink = $imageLink;
    }


    /**
     * Gets the imageZoom
     *
     * @return string
     */
    public function getImageZoom(): string
    {
        return $this->imageZoom;
    }


    /**
     * Sets the the imageZoom
     *
     * @param string $imageZoom
     */
    public function setImageZoom(string $imageZoom): void
    {
        $this->imageZoom = $imageZoom;
    }

    /**
     * Gets the altText
     *
     * @return string
     */
    public function getAltText(): string
    {
        return $this->altText;
    }


    /**
     * Sets the altText
     *
     * @param string $altText
     * @return void
     */
    public function setAltText(string $altText): void
    {
        $this->altText = $altText;
    }


    /**
     * Gets the titleText
     *
     * @return string
     */
    public function getTitleText(): string
    {
        return $this->titleText;
    }


    /**
     * Sets the titleText
     *
     * @param string $titleText
     * @return void
     */
    public function setTitleText(string $titleText): void
    {
        $this->titleText = $titleText;
    }


    /**
     * Gets the headerLayout
     *
     * @return string
     */
    public function getHeaderLayout(): string
    {
        return $this->headerLayout;
    }


    /**
     * Sets the headerLayout
     *
     * @param string $headerLayout
     * @return void
     */
    public function setHeaderLayout(string $headerLayout): void
    {
        $this->headerLayout = $headerLayout;
    }


    /**
     * Get the listType
     *
     * @return string
     */
    public function getListType(): string
    {
        return $this->listType;
    }


    /**
     * Gets the listType
     *
     * @param string $listType
     * @return void
     */
    public function setListType(string $listType): void
    {
        $this->listType = $listType;
    }
}
