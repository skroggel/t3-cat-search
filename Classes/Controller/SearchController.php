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

use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Exception;


/**
 * Class SearchController
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
final class SearchController extends AbstractSearchController
{

    /**
     * @var \TYPO3\CMS\Core\Cache\Frontend\FrontendInterface|null
     */
    protected ?FrontendInterface $cache = null;


    /**
     * @param \TYPO3\CMS\Core\Cache\Frontend\FrontendInterface $cache
     * @return void
     */
    public function injectCache(FrontendInterface $cache): void
    {
        $this->cache = $cache;
    }


    /**
     * Separate method for available filter options with cache.
     *
     * @return array
     * @throws Exception
     * @throws \Doctrine\DBAL\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    protected function getFilterOptions (): array
    {
        $languageId = $this->siteLanguage->getLanguageId();
        $cacheIdentifier = 'filteroptions_' . $languageId;

        if (!$filters = $this->cache->get($cacheIdentifier)) {

            $filters = parent::getFilterOptions();
            $this->cache->set(
                $cacheIdentifier,
                $filters,
                ['madj2kcatsearch_filteroptions', 'madj2kcatsearch_filteroptions_' . $languageId]);
        }

        return $filters;
    }



}
