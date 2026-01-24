<?php
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Package\PackageManager;

/** @var \TYPO3\CMS\Core\Package\PackageManager $packageManager */
$packageManager = GeneralUtility::makeInstance(PackageManager::class);
$deepLInstalled =  $packageManager->isPackageActive('deepltranslate_core');

$ll = 'LLL:EXT:cat_search/Resources/Private/Language/locallang_db.xlf:';
return [
	'ctrl' => [
		'title' => $ll .'tx_catsearch_domain_model_manufacturer',
		'label' => 'title',
		'dividers2tabs' => true,
		'default_sortby' => 'ORDER BY title ASC',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'searchFields' => 'title',
		'iconfile' => 'EXT:cat_search/Resources/Public/Icons/tx_catsearch_domain_model_manufacturer.svg',
	],
	'types' => [
		'1' => ['showitem' => 'title, title_long, image,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'
		],
	],
	'columns' => [
		'sys_language_uid' => [
			'exclude' => false,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => ['type' => 'language'],
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['label' => '', 'value' => 0],
				],
				'foreign_table' => 'tx_catsearch_domain_model_manufacturer',
				'foreign_table_where' => 'AND {#tx_catsearch_domain_model_manufacturer}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_manufacturer}.{#sys_language_uid} IN (-1,0)',
			],
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
		'hidden' => [
			'exclude' => false,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
			],
		],
		'starttime' => [
			'exclude' => false,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'datetime',
				'size' => 13,
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				],
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'endtime' => [
			'exclude' => false,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'datetime',
				'size' => 13,
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				],
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'title' => [
			'exclude' => false,
            'l10n_mode' => ($deepLInstalled ? 'prefixLangTitle' : ''),
			'label' => $ll .'tx_catsearch_domain_model_manufacturer.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
                'required' => true
			],
		],
        'title_long' => [
            'exclude' => false,
            'l10n_mode' => ($deepLInstalled ? 'prefixLangTitle' : ''),
            'label' => $ll .'tx_catsearch_domain_model_manufacturer.title_long',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'image' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_manufacturer.image',
            'config' => [
                'type' => 'file',
                'allowed' => ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp'],
                'maxitems' => 1,
            ],
        ],
	],
];
