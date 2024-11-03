<?php
$ll = 'LLL:EXT:cat_search/Resources/Private/Language/locallang_db.xlf:';

return [
	'ctrl' => [
		'title' => $ll .'tx_catsearch_domain_model_filtertype',
		'label' => 'title',
		'cruser_id' => 'cruser_id',
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
		'1' => ['showitem' => 'title, filters,
					--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource,
					--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'
		],
	],
	'columns' => [
		'sys_language_uid' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => [
					['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1],
					['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0]
				],
				'default' => 0
			],
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 0,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['', 0],
				],
				'foreign_table' => 'tx_catsearch_domain_model_filtertype',
				'foreign_table_where' => 'AND tx_catsearch_domain_model_filtertype.pid=###CURRENT_PID### AND tx_catsearch_domain_model_filtertype.sys_language_uid IN (-1,0)',
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
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'size' => 13,
				'eval' => 'datetime',
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
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'size' => 13,
				'eval' => 'datetime',
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
			'label' => $ll .'tx_catsearch_domain_model_filtertype.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			],
		],
		'filters' => [
			'exclude' => false,
			'label' => $ll .'tx_catsearch_domain_model_filtertype.filters',
			'l10n_mode' => 'exclude',
			'config' => [
				'readOnly' => true,
				'type' => 'group',
				'allowed' => 'tx_catsearch_domain_model_filter',
				'foreign_table' => 'tx_catsearch_domain_model_filter',
                'foreign_table_where' => 'AND tx_catsearch_domain_model_filter.sys_language_uid IN (-1,0) AND tx_catsearch_domain_model_filter.hidden = 0 AND tx_catsearch_domain_model_filter.deleted = 0 ORDER BY tx_catsearch_domain_model_filter.title',
                'foreign_field' => 'type',
				'size' => 10,
				'maxitems' => 9999
			],
		],
	],
];
