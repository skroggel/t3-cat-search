<?php
defined('TYPO3') or die('Access denied.');

call_user_func(
	function($extensionKey)
	{

        $pluginConfig = [
            'Search' => ['flexFormFile' => 'Search'],
            'SearchRelated' => ['flexFormFile' => 'SearchRelated'],
            'TeaserFiltered' => ['flexFormFile' => 'TeaserFiltered'],
            'Detail' => ['flexFormFile' => 'Detail'],
        ];

        foreach ($pluginConfig as $pluginName => $pluginSettings) {

            $pluginTitle = 'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_be.xlf:plugin.tx_catsearch_' .
                strtolower($pluginName). '.title';

            $pluginIcon =  'catsearch-plugin-' . strtolower($pluginName);

            // register normal plugin
            $pluginSignature = \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
                $extensionKey,
                $pluginName,
                $pluginTitle,
                $pluginIcon
            );

            $flexFormFile = $pluginName;
            if (isset($pluginSettings['flexFormFile'])) {
                $flexFormFile = $pluginSettings['flexFormFile'];
            }

            $flexFormFile = 'EXT:'. $extensionKey . '/Configuration/FlexForms/' . $flexFormFile . '.xml';
            $file = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($flexFormFile);
            if (
                ($file)
                && (file_exists($file))
            ) {

                // add flexform to plugin
                $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
                \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
                    '*', // wildcard when using third parameter, else use pluginSignature
                    'FILE:' . $flexFormFile,
                    $pluginSignature // third parameter adds flexform to content-element below, too!
                );
            }

            // add content element
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
                'tt_content',
                'CType',
                [
                    'label' => $pluginTitle,
                    'value' => $pluginSignature,
                    'icon'  => $pluginIcon,
                    'group' => $extensionKey,
                ]
            );

            // define TCA-fields
            // $GLOBALS['TCA']['tt_content']['types'][$pluginSignature] = $GLOBALS['TCA']['tt_content']['types']['list'];
         //   var_dump($GLOBALS['TCA']['tt_content']['types']['list']);
           // die();
            $GLOBALS['TCA']['tt_content']['types'][$pluginSignature]['showitem'] = '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;;general,
                     header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
                     --linebreak--,
                     header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
                     --linebreak--,
                     subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,
                    pi_flexform,
                    pages;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:pages.ALT.list_formlabel,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                    --palette--;;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                    rowDescription,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ';
        }
	},
	'cat_search'
);
