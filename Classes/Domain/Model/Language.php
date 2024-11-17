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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Language
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Language extends AbstractEntity
{

	/**
	 * @var string
	 */
	protected string $title = '';


    /**
     * @var string
     */
    protected string $iso2Key = '';


    /**
     * @var string
     */
    protected string $iso3Key = '';


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
     * Gets the iso2Key
     *
     * @return string
     */
    public function getIso2Key(): string
    {
        return $this->iso2Key;
    }


    /**
     * Sets the iso2Key
     *
     * @param string $iso2Key iso2Key
     */
    public function setIso2Key(string $iso2Key): void
    {
        $this->iso2Key = $iso2Key;
    }



    /**
     * Gets the iso3Key
     *
     * @return string
     */
    public function getIso3Key(): string
    {
        return $this->iso3Key;
    }


    /**
     * Sets the iso3Key
     *
     * @param string $iso3Key iso3Key
     */
    public function setIso3Key(string $iso3Key): void
    {
        $this->iso3Key = $iso3Key;
    }

}
