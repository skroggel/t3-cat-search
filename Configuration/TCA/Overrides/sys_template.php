<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(
    function($extKey)
    {

        ExtensionManagementUtility::addStaticFile(
            $extKey,
            'Configuration/TypoScript',
            'CatSearch'
        );

    },
    'cat_search'
);
