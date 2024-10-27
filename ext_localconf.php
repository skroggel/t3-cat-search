<?php
defined('TYPO3_MODE') || defined('TYPO3') ||die('Access denied.');

call_user_func(
    function($extKey)
    {
        //=================================================================
        // Configure Plugins
        //=================================================================
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            $extKey,
            'Search',
            [
                \Madj2k\CatSearch\Controller\SearchController::class => 'search,removeSearchFilter,removeAllSearchFilters'
            ],
            [
                \Madj2k\CatSearch\Controller\SearchController::class => 'search,removeSearchFilter,removeAllSearchFilters'
            ],
        );

        //=================================================================
        // Hooks
        //=================================================================
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$extKey] =
            \Madj2k\CatSearch\Hooks\TCEMainHook::class;

        //=================================================================
        // cHash
        //=================================================================
        $GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParameters'][] = '^tx_catsearch_search[search]';

        //=================================================================
        // Cache
        //=================================================================
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['catsearch_filteroptions'] ??= [];


    },
    'cat_search'
);
