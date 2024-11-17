<?php
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3_MODE') || defined('TYPO3') ||die('Access denied.');

call_user_func(
    function($extKey)
    {
        $configReader = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        $extensionConfig = $configReader->get('cat_search');

        if (
            (isset($extensionConfig['contentElementsDefaultCType']))
            && ($defaultCType = $extensionConfig['contentElementsDefaultCType'])
        ) {
            $GLOBALS['TCA']['tx_catsearch_domain_model_filterable']['columns']['content_elements']['config']
                ['overrideChildTca']['columns']['CType']['config']['default'] = $defaultCType;
        }

    },
    'cat_search'
);

