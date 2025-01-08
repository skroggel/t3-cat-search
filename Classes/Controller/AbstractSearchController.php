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
use Madj2k\CatSearch\Domain\Model\Filterable;
use Madj2k\CatSearch\Domain\Model\FilterableInterface;
use Madj2k\CatSearch\Domain\Repository\FilterableRepository;
use Madj2k\CatSearch\Domain\Repository\FilterRepository;
use Madj2k\CatSearch\Domain\Repository\FilterTypeRepository;
use Madj2k\CatSearch\PageTitle\PageTitleProvider;
use Madj2k\CatSearch\Utilities\SearchParameterUtility;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Pagination\SlidingWindowPagination;
use TYPO3\CMS\Core\Site\Entity\SiteLanguage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\Generic\Exception;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
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
     * @var \Madj2k\CatSearch\Domain\Repository\FilterTypeRepository|null
     */
    protected ?FilterTypeRepository $filterTypeRepository = null;


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
    public function injectFilterableRepository(FilterableRepository $filterableRepository): void
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
     * @param \Madj2k\CatSearch\Domain\Repository\FilterTypeRepository $filterTypeRepository
     * @return void
     */
    public function injectFilterTypeRepository(FilterTypeRepository $filterTypeRepository): void
    {
        $this->filterTypeRepository = $filterTypeRepository;
    }


    /**
     * Assign default variables to view
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
	protected function initializeView(): void
	{
		$this->view->assign('data', $this->request->getAttribute('currentContentObject')->data);
        $this->view->assign('hashedParametersLink', $this->getHashLinkFromSearchParams());

        // check for layout - and for layout of item for detail view!
        $layout = $this->settings['layout'] ?? 'default';
        if ($this->arguments->hasArgument('item')) {
            $item = $this->arguments->getArgument('item')->getValue();

            if ($item instanceof FilterableInterface) {
                $layout = $item->getLayout();
            }
        }

        // set layout specific settings in separate array
        if (
            (isset($this->settings['layoutOverride'][$layout]))
            && (is_array($this->settings['layoutOverride'][$layout]))
        ){
            $layoutSettings = $this->settings['layoutOverride'][$layout];
            $settings = $this->settings;
            unset($settings['layoutOverride']);
            $this->view->assign('settingsForLayout', array_merge($settings, $layoutSettings));
        }
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
     * Allow mapping of properties to DTO even if no object is submitted (e.g. when using GET)
     *
     * @return void
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    public function initializeSearchRelatedAction(): void
    {
        if ($this->arguments->hasArgument('search')) {
            $propertyMappingConfiguration = $this->arguments->getArgument('search')->getPropertyMappingConfiguration();
            $propertyMappingConfiguration->allowAllProperties();
        }
    }


    /**
     * action teaserFiltered
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function teaserFilteredAction(): ResponseInterface
    {
        $results = $this->filterableRepository->findBySettings($this->settings);
        $this->view->assignMultiple([
            'results' => $results
        ]);

        return $this->htmlResponse();
    }


    /**
     * action detail
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable|null $item
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException
     * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException
     */
    public function detailAction(?Filterable $item = null): ResponseInterface
    {
        if (
            (!$item)
            && (isset($this->settings['item']))
        ){
            $item = $this->filterableRepository->findByUid((int) $this->settings['item']);
        }

        if ($item) {
            $providerClass = $this->settings['pageTitleProvider'] ?? PageTitleProvider::class;

            /** @var \Madj2k\CatSearch\PageTitle\PageTitleProviderInterface $provider */
            $provider = GeneralUtility::makeInstance($providerClass);
            $provider->setTitle($item);
        }

        $this->view->assignMultiple([
            'item' => $item,
            'siteLanguage' => $this->siteLanguage,
        ]);

        return $this->htmlResponse();
    }


    /**
     * action detail2
     *
     * @param \Madj2k\CatSearch\Domain\Model\Filterable|null $item
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException
     * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException
     */
    public function detail2Action(?Filterable $item = null): ResponseInterface
    {
        return $this->detailAction($item);
    }


    /**
     * action related
     *
     * @param \Madj2k\CatSearch\Domain\DTO\Search|null $search
     * @param int $currentPage
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     * @throws \TYPO3\CMS\Extbase\Security\Exception\InvalidArgumentForHashGenerationException
     * @throws \TYPO3\CMS\Extbase\Security\Exception\InvalidHashException
     */
    public function searchRelatedAction(Search $search = null, int $currentPage = 1): ResponseInterface
    {
        if (! $this->settings['useSessionCookie']) {

            // get queryParams from regular search
            $queryParams = $this->request->getQueryParams();
            if (
                (isset($queryParams['tx_catsearch_search']))
                && (isset($queryParams['tx_catsearch_search']['search']))
            ){
                $params = $queryParams['tx_catsearch_search']['search'];
                $search = GeneralUtility::makeInstance(Search::class);

                foreach ($params as $param => $value) {
                    if (!empty($value)) {
                        $setter = 'set' . ucfirst($param);
                        if (method_exists($search, $setter)) {
                            if (is_numeric($value)) {
                                $search->$setter((int)$value);
                            } else {
                                $search->$setter($value);
                            }
                        }
                    }
                }
            }
        }

        // load from session or init new one - do not save it to session here!!!!
        if (!$search && (!$search = $this->loadSearchfromSession())) {
            $search = GeneralUtility::makeInstance(Search::class);
        }

        $results = $this->getSearchResults($search);

        $layoutKey = $search->getLayout() ?? $this->settings['layout'] ?? 'default';
        $maxItemsPerPage = (int) $this->settings['maxResultsPerPage'] ?? 10;
        if (isset($this->settings[$layoutKey]['maxResultsPerPage'])) {
            $maxItemsPerPage = (int) $this->settings[$layoutKey]['maxResultsPerPage'];
        }

        $maxPages = (int) $this->settings['maxPages'] ?? 3;
        if (isset($this->settings[$layoutKey]['maxPages'])) {
            $maxPages = (int) $this->settings[$layoutKey]['maxPages'];
        }

        /** @var \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator $paginator */
        $paginator = new QueryResultPaginator(
            $results,
            $currentPage,
            $maxItemsPerPage
        );

        /** @var \TYPO3\CMS\Core\Pagination\SlidingWindowPagination $pagination */
        $pagination = new SlidingWindowPagination(
            $paginator,
            $maxPages,
        );

        $this->view->assignMultiple([
            'search' => $search,
            'paginator' => $paginator,
            'pagination' => $pagination,
            'resultCount' => $results->count(),
        ]);

        return $this->htmlResponse();
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
     * @throws \TYPO3\CMS\Extbase\Security\Exception\InvalidArgumentForHashGenerationException
     * @throws \TYPO3\CMS\Extbase\Security\Exception\InvalidHashException
     */
	public function searchAction(Search $search = null, int $currentPage = 0, bool $useSessionPage = false): ResponseInterface
	{
        // check if there is a hash with search-parameters given
        if ($parameters = SearchParameterUtility::unserializeParameters($this->request)) {
            $parameters['currentPage'] = $currentPage;
            $parameters['useSessionPage'] = $useSessionPage;
            return $this->redirect($this->request->getControllerActionName(), null, null, $parameters);
        }

		// load from session or init new one
		if (!$search && (!$search = $this->loadSearchfromSession())) {
			$search = GeneralUtility::makeInstance(Search::class);
		}

		// if useSessionPage is TRUE and no explicit page is given,
		// we may be coming from the detail view back to the search
		// in this case we want the results to start at the correct page.
		// if useSessionPage is FALSE set current page in search-DTO and
		// store object in session - no matter if it is new, given as param
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

        // get results
        $results = $this->getSearchResults($search, false);

        // check for settings for pagination
        $layoutKey = $search->getLayout() ?? $this->settings['layout'] ?? 'default';
        $maxItemsPerPage = (int) $this->settings['maxResultsPerPage'] ?? 10;
        if (isset($this->settings[$layoutKey]['maxResultsPerPage'])) {
            $maxItemsPerPage = (int) $this->settings[$layoutKey]['maxResultsPerPage'];
        }

        $maxPages = (int) $this->settings['maxPages'] ?? 3;
        if (isset($this->settings[$layoutKey]['maxPages'])) {
            $maxPages = (int) $this->settings[$layoutKey]['maxPages'];
        }

		/** @var \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator $paginator */
		$paginator = new QueryResultPaginator(
			$results,
			$currentPage,
			$maxItemsPerPage
		);

		/** @var \TYPO3\CMS\Core\Pagination\SlidingWindowPagination $pagination */
		$pagination = new SlidingWindowPagination(
			$paginator,
            $maxPages,
		);

		$this->view->assignMultiple([
			'search' => $search,
			'paginator' => $paginator,
			'pagination' => $pagination,
			'resultCount' => $results->count(),
			'searchOptions' => $this->getSearchOptions(),
            'hash' => $this->getHashFromSearchParams()
		]);

		return $this->htmlResponse();
	}


	/**
	 * action removeSearchFilter
	 *
	 * @param string $property
	 * @param string $value
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function removeSearchFilterAction(string $property, string $value = ''): ResponseInterface
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
     */
    protected function getSearchOptions (): array
    {
        $languageId = $this->siteLanguage->getLanguageId();

        // Store the data in cache
        $searchOptions = [
            'filters' => [],
            'filtersCombined' => [],
            'years' => $this->filterableRepository->findAssignedYears(
                $languageId,
                $this->settings,
            ),
            'relatedProducts' => $this->filterableRepository->findAssignedRelatedProducts(
                $languageId,
                $this->settings,
            ),
            'sorting' => GeneralUtility::trimExplode(',', $this->settings['sorting'] ?? '')
        ];

        // get all defined filterTypes
        foreach (range(1, 5) as $filterNumber) {
            if (
                (isset($this->settings['filterType' . $filterNumber]))
                && ($this->settings['filterType' . $filterNumber])
            ) {

                $filterOptions = $this->filterRepository->findAssignedByLanguageAndType(
                    $languageId,
                    (int)$this->settings['filterType' . $filterNumber],
                    $this->settings
                );

                // add all options to one big array for tags
                $searchOptions['filtersCombined'] += $filterOptions;

                // add filterOptions with filterType to separate array
                // in order to be able to cache the filters we can not add an object here!
                /** @var \Madj2k\CatSearch\Domain\Model\FilterType $filterType */
                $filterType = $this->filterTypeRepository->findByUid($this->settings['filterType' . $filterNumber]);

                $filterName = 'filter' . $filterNumber;
                if ($this->settings['filterType' . $filterNumber . 'AllowMultiple']) {
                    $filterName = 'multiSelectFilter' . $filterNumber;
                }

                $searchOptions['filters'][$filterName] = [
                    'filterType' => [
                        'uid' => $filterType->getUid(),
                        'title' => $filterType->getTitle()
                    ],
                    'filterOptions' => $filterOptions,
                    'allowMultiple' => (bool)$this->settings['filterType' . $filterNumber . 'AllowMultiple'] ?? false
                ];
            }
        }

        return $searchOptions;
    }


	/**
	 * Save data to frontend user session
	 *
	 * @param \Madj2k\CatSearch\Domain\DTO\Search $search
	 * @return void
	 */
	protected function saveSearchToSession(Search $search): void
	{
        if ($this->settings['useSessionCookie']) {
            // bind it to uid in order to work with different filters on different pages!
            $uid = (int) $this->currentContentObject->data['uid'];
            $frontendUser = $this->request->getAttribute('frontend.user');
            $frontendUser->setKey('ses', 'madj2kcatsearch_search_' . $uid, serialize($search));
            $frontendUser->storeSessionData();
        }
	}


	/**
	 * Load data from frontend user session
	 *
	 * @return \Madj2k\CatSearch\Domain\DTO\Search|null
	 */
	protected function loadSearchFromSession(): ?Search
	{
        if ($this->settings['useSessionCookie']) {
            // bind it to pid in order to work with different filters on different pages!
            $uid = (int)$this->currentContentObject->data['uid'];
            $frontendUser = $this->request->getAttribute('frontend.user');
            if ($data = $frontendUser->getKey('ses', 'madj2kcatsearch_search_' . $uid)) {
                return unserialize($data) ?? null;
            }
        }
		return null;
	}


    /**
     * Get a hash from the search params
     *
     * @return string
     */
    protected function getHashFromSearchParams(): string
    {
        if ($hmac = SearchParameterUtility::serializeParameters($this->request)) {
            return $hmac;
        }

        return '';
    }


    /**
     * Get a hash-link from the search params
     *
     * @return string
     */
    protected function getHashLinkFromSearchParams(): string
    {
        if ($hmac = $this->getHashFromSearchParams()) {
            $parameterNamespace = SearchParameterUtility::getParameterNamespace($this->request);
            return $this->uriBuilder
                ->reset()
                ->setRequest($this->request)
                ->setArguments([$parameterNamespace => ['hash' => $hmac]])
            ->build();
        }

        return '';
    }

}
