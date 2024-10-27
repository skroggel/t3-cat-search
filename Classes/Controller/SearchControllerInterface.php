<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\Controller;

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

use Madj2k\CatSearch\Domain\DTO\Search;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Core\Pagination\SlidingWindowPagination;
use TYPO3\CMS\Core\Site\Entity\SiteLanguage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\Generic\Exception;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
/**
 * Class SearchControllerInterface
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
interface SearchControllerInterface
{

	/**
	 * action search
	 *
	 * @param \Madj2k\CatSearch\Domain\DTO\Search|null $search
	 * @param int $currentPage
	 * @param bool $useSessionPage
	 * @return \Psr\Http\Message\ResponseInterface
	 * @throws \Doctrine\DBAL\Exception
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
	 * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
	 */
	public function searchAction(Search $search = null, int $currentPage = 0, bool $useSessionPage = false): ResponseInterface;


	/**
	 * action removeSearchFilter
	 *
	 * @param string $property
	 * @param int $value
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function removeSearchFilterAction(string $property, int $value = 0): ResponseInterface;


	/**
	 * action removeAllSearchFilters
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function removeAllSearchFiltersAction(): ResponseInterface;


}
