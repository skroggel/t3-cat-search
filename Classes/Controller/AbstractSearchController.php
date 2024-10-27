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
use Madj2k\CatSearch\Domain\Repository\FilterableRepository;
use Madj2k\CatSearch\Domain\Repository\FilterRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Pagination\SlidingWindowPagination;
use TYPO3\CMS\Core\Site\Entity\SiteLanguage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\Generic\Exception;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Class AbstractSearchController
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
abstract class AbstractSearchController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController implements SearchControllerInterface
{

    /**
     * @var \Madj2k\CatSearch\Domain\Repository\FilterableRepository|null
     */
    protected ?FilterableRepository $filterableRepository = null;


    /**
     * @var \Madj2k\CatSearch\Domain\Repository\FilterRepository|null
     */
    protected ?FilterRepository $filterRepository = null;


	/**
	 * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer|null $currentContentObject
	 */
	protected ?ContentObjectRenderer $currentContentObject = null;


	/**
	 * @var \TYPO3\CMS\Core\Site\Entity\SiteLanguage|null
	 */
	protected ?SiteLanguage $siteLanguage = null;


    /**
     * @param \Madj2k\CatSearch\Domain\Repository\FilterableRepository $filterableRepository
     * @return void
     */
    public function injectItemRepository(FilterableRepository $filterableRepository): void
    {
        $this->filterableRepository = $filterableRepository;
    }


    /**
     * @param \Madj2k\CatSearch\Domain\Repository\FilterRepository $filterRepository
     * @return void
     */
    public function injectFilterRepository(FilterRepository $filterRepository): void
    {
        $this->filterRepository = $filterRepository;
    }


    /**
	 * Assign default variables to view
	 */
	protected function initializeView(): void
	{
		$this->view->assign('data', $this->request->getAttribute('currentContentObject')->data);
	}


	/**
	 * Set globally used objects
	 */
	protected function initializeAction(): void
	{
		$this->currentContentObject = $this->request->getAttribute('currentContentObject');
		$this->siteLanguage = $this->request->getAttribute('language');
	}


	/**
	 * Allow mapping of properties to DTO even if no object is submitted (e.g. when using GET)
	 *
	 * @return void
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 */
	public function initializeSearchAction(): void
	{
		if ($this->arguments->hasArgument('search')) {
			$propertyMappingConfiguration = $this->arguments->getArgument('search')->getPropertyMappingConfiguration();
			$propertyMappingConfiguration->allowAllProperties();
		}
	}


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
	public function searchAction(Search $search = null, int $currentPage = 0, bool $useSessionPage = false): ResponseInterface
	{
		// load from session or init new one
		if (!$search && (!$search = $this->loadSearchfromSession())) {
			$search = GeneralUtility::makeInstance(Search::class);
		}

		// if useSessionPage is TRUE and no explicit page is given,
		// we may be coming from the detail view back to the search
		// in this case we want the results to start at the correct page
		// if useSessionPage is FALSE set current page in search-DTO and
		// store object in session no matter if it is new, given as param
		// or loaded from session
		if ($useSessionPage && $currentPage == 0) {
			$currentPage = $search->getCurrentPage() ?? 1;
		} else {
			if ($currentPage < 1) {
				$currentPage = 1;
			}
			$search->setCurrentPage($currentPage);
		}
		$this->saveSearchToSession($search);

		$layoutKey = $search->getLayout() ?? 'list';
        $results = $this->getSearchResults($search);

		/** @var \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator $paginator */
		$paginator = new QueryResultPaginator(
			$results,
			$currentPage,
			((isset($this->settings[$layoutKey]['maxItemsPerPage']) && intval($this->settings[$layoutKey]['maxItemsPerPage'])) ?: 3)
		);

		/** @var \TYPO3\CMS\Core\Pagination\SlidingWindowPagination $pagination */
		$pagination = new SlidingWindowPagination(
			$paginator,
            ((isset($this->settings[$layoutKey]['maxItemsPerPage']) && intval($this->settings[$layoutKey]['maxPagesShown'])) ?: 3)
		);

		$this->view->assignMultiple([
			'search' => $search,
			'paginator' => $paginator,
			'pagination' => $pagination,
			'resultCount' => $results->count(),
			'filterOptions' => $this->getFilterOptions()
		]);

		return $this->htmlResponse();
	}


	/**
	 * action removeSearchFilter
	 *
	 * @param string $property
	 * @param int $value
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function removeSearchFilterAction(string $property, int $value = 0): ResponseInterface
	{
		if ($search = $this->loadSearchfromSession()) {
			$search->unsetProperty($property, $value);
			$this->saveSearchToSession($search);
		}

		return $this->redirect('search');
	}


	/**
	 * action removeAllSearchFilters
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function removeAllSearchFiltersAction(): ResponseInterface
	{
		/** @var \Madj2k\CatSearch\Domain\DTO\Search $search */
		$search = GeneralUtility::makeInstance(Search::class);

		// get view-settings from existing search
		if ($searchInSession = $this->loadSearchfromSession()) {
			$search->setSorting($searchInSession->getSorting());
			$search->setLayout($searchInSession->getLayout());
		}
		$this->saveSearchToSession($search);
		return $this->redirect('search');
	}


    /**
     * Separate method for search results. This way we can override it easily
     *
     * @param \Madj2k\CatSearch\Domain\DTO\Search $search
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     */
    protected function getSearchResults (Search $search): QueryResultInterface
    {
        return $this->filterableRepository->findBySearch($search, $this->settings);
    }


    /**
     * Separate method for available filter options. This way we can override it easily
     *
     * @return array
     * @throws Exception
     * @throws \Doctrine\DBAL\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    protected function getFilterOptions (): array
    {
        $languageId = $this->siteLanguage->getLanguageId();

        // Store the data in cache
        $filters = [
            'years' => $this->filterableRepository->findAllYearsAssigned(
                $languageId,
            ),
            'sorting' => GeneralUtility::trimExplode(',', $this->settings['sorting'] ?? '')
        ];

        // get all defined filterTypes
        foreach (range(1, 5) as $filterNumber) {
            if (
                (isset($this->settings['filterType' . $filterNumber]))
                && ($this->settings['filterType' . $filterNumber])
            ){
                $filters['filter' . $filterNumber] = $this->filterRepository->findAllAssignedByLanguageAndType(
                    $languageId,
                    (int) $this->settings['filterType' . $filterNumber],
                );
            }
        }

        return $filters;
    }


	/**
	 * Save data to frontend user session
	 *
	 * @param \Madj2k\CatSearch\Domain\DTO\Search $search
	 * @return void
	 */
	protected function saveSearchToSession(Search $search): void
	{
		$frontendUser = $this->request->getAttribute('frontend.user');
		$frontendUser->setKey('ses', 'madj2kcatsearch_search', serialize($search));
		$frontendUser->storeSessionData();
	}


	/**
	 * Load data from frontend user session
	 *
	 * @return \Madj2k\CatSearch\Domain\DTO\Search|null
	 */
	protected function loadSearchFromSession(): ?Search
	{
		$frontendUser = $this->request->getAttribute('frontend.user');
		if ($data = $frontendUser->getKey('ses', 'madj2kcatsearch_search')) {
            return unserialize($data)?? null;
		}
		return null;
	}

}
