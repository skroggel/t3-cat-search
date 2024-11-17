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

/**
 * Class Rubric
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Category extends AbstractEntity
{

	/**
	 * @var string
	 */
	protected string $title = '';


    /**
     * @var string
     */
    protected string $titleLong = '';


    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $image = null;


	/**
	 * Gets the title
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
	 * @param string $title title
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}


    /**
     * Gets the titleLong
     *
     * @return string
     */
    public function getTitleLong(): string
    {
        return $this->titleLong;
    }


    /**
     * Sets the titleLong
     *
     * @param string $titleLong titleLong
     */
    public function setTitleLong(string $titleLong): void
    {
        $this->titleLong = $titleLong;
    }


    /**
     * Gets the combined title
     *
     * @return string
     */
    public function getTitleCombined(): string
    {
        return $this->titleLong ?: $this->title;
    }



    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference|null $image
     */
    public function getImage(): ?FileReference
    {
        return $this->image;
    }


    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(FileReference $image): void
    {
        $this->image = $image;
    }
}
