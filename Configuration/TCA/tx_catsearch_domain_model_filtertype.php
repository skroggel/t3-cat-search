<?php
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Package\PackageManager;

/** @var \TYPO3\CMS\Core\Package\PackageManager $packageManager */
$packageManager = GeneralUtility::makeInstance(PackageManager::class);
$deepLInstalled =  $packageManager->isPackageActive('deepltranslate_core');

$ll = 'LLL:EXT:cat_search/Resources/Private/Language/locallang_db.xlf:';

return [
	'ctrl' => [
		'title' => $ll .'tx_catsearch_domain_model_filtertype',
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
		'iconfile' => 'EXT:cat_search/Resources/Public/Icons/tx_catsearch_domain_model_filtertype.svg',
	],
	'types' => [
		'1' => ['showitem' => 'title, title_long, is_internal, filters,
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
				'foreign_table' => 'tx_catsearch_domain_model_filtertype',
				'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filtertype}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filtertype}.{#sys_language_uid} IN (-1,0)',
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
			'label' => $ll .'tx_catsearch_domain_model_filtertype.title',
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
            'label' => $ll .'tx_catsearch_domain_model_filtertype.title_long',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'is_internal' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filtertype.is_internal',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ],
        ],
        'filters' => [
			'exclude' => false,
			'label' => $ll .'tx_catsearch_domain_model_filtertype.filters',
			'config' => [
                'type' => 'inline',
				'allowed' => 'tx_catsearch_domain_model_filter',
				'foreign_table' => 'tx_catsearch_domain_model_filter',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filter}.{#sys_language_uid} IN (-1,0) AND {#tx_catsearch_domain_model_filter}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filter}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filter.title',
                'foreign_field' => 'type',
                'foreign_sortby' => 'sorting',
				'size' => 10,
				'maxitems' => 9999,
                'appearance'    => [
                    'useSortable'        => true,
                    'levelLinksPosition' => 'both',
                ],
			],
		],
	],
];
