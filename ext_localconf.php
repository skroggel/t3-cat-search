<?php
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Madj2k\CatSearch\Controller\SearchController;
use Madj2k\CatSearch\Hooks\TCEMainHook;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use Madj2k\CatSearch\Hooks\KeSearch\ProductIndexer;
use Madj2k\CatSearch\Hooks\KeSearch\DocumentIndexer;
use Madj2k\CatSearch\Hooks\KeSearch\AccessoryIndexer;

if (!defined('TYPO3') && !defined('TYPO3')) {
    die('Access denied.');
}
call_user_func(
    function($extKey)
    {
        //=================================================================
        // Configure Plugins
        //=================================================================
        ExtensionUtility::configurePlugin(
            $extKey,
            'Search',
            [
                SearchController::class => 'search,removeSearchFilter,removeAllSearchFilters'
            ],
            [
                SearchController::class => 'search,removeSearchFilter,removeAllSearchFilters'
            ],
            ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT

        );

        ExtensionUtility::configurePlugin(
            $extKey,
            'TeaserFiltered',
            [
                SearchController::class => 'teaserFiltered'
            ],
            [

            ],
            ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT

        );

        ExtensionUtility::configurePlugin(
            $extKey,
            'SearchRelated',
            [
                SearchController::class => 'searchRelated'
            ],
            [
                SearchController::class => 'searchRelated'
            ],
            ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT

        );

        ExtensionUtility::configurePlugin(
            $extKey,
            'Detail',
            [
                SearchController::class => 'detail'
            ],
            [
                SearchController::class => 'detail'
            ],
            ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
        );

        ExtensionUtility::configurePlugin(
            $extKey,
            'Detail2',
            [
                SearchController::class => 'detail2'
            ],
            [
                SearchController::class => 'detail2'
            ],
            ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
        );
        //=================================================================
        // Routing
        //=================================================================
       // $GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['enhancers']['SearchEnhancer'] =
       //     \Madj2k\CatSearch\Routing\SearchEnhancer::class;

        //=================================================================
        // Hooks
        //=================================================================
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$extKey] =
            TCEMainHook::class;

        if (ExtensionManagementUtility::isLoaded('ke_search')) {
            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerIndexerConfiguration'][] =
                ProductIndexer::class;
            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customIndexer'][] =
                ProductIndexer::class;

            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerIndexerConfiguration'][] =
                DocumentIndexer::class;
            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customIndexer'][] =
                DocumentIndexer::class;

            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerIndexerConfiguration'][] =
                AccessoryIndexer::class;
            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customIndexer'][] =
                AccessoryIndexer::class;

        }

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
