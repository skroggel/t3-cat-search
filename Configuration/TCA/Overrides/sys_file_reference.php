<?php
defined('TYPO3') or die('Access denied.');

call_user_func(
	function($extensionKey)
	{

        $ll = 'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_db.xlf:';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference',
            [
                'tx_catsearch_header' => [
                    'exclude' => 0,
                    'label' =>  $ll  . 'sys_file_reference.tx_catsearch_header',
                    'config' => [
                        'type' => 'passthrough', // default type is passthrough - it is overridden when field is needed
                        'size' => 60,
                        'eval' => 'trim',
                    ]
                ],
                'tx_catsearch_bodytext' => [
                    'exclude' => 0,
                    'label' =>  $ll  . 'sys_file_reference.tx_catsearch_bodytext',
                    'config' => [
                        'type' => 'passthrough', // default type is passthrough - it is overridden when field is needed
                        'cols' => 40,
                        'rows' => 10,
                        'eval' => 'trim',
                        'enableRichtext' => true
                    ]
                ],
            ],
        );

        // addFieldsToPalette
        foreach (
            [
                'basicoverlayPalette' => 'description',
                'imageoverlayPalette' => 'crop',
                'videoOverlayPalette' => 'autoplay',
                'audioOverlayPalette' => 'autoplay'
            ] as $palette =>  $insertAfter) {

            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
                'sys_file_reference',
                $palette,
                '--linebreak--, tx_catsearch_header, --linebreak--,tx_catsearch_bodytext ',
                'after:' . $insertAfter
            );
        }


        // activate some special field in sys_file_reference only on certain fields!
        foreach (['images', 'media_files'] as $field) {
            $GLOBALS['TCA']['tx_catsearch_domain_model_filterable']['columns'][$field]['config']['overrideChildTca']['columns']['tx_catsearch_header']['config']['type'] = 'input';
            $GLOBALS['TCA']['tx_catsearch_domain_model_filterable']['columns'][$field]['config']['overrideChildTca']['columns']['tx_catsearch_bodytext']['config']['type'] = 'text';
        }
	},
	'cat_search'
);
