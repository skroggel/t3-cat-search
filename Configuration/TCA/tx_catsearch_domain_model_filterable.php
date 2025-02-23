<?php
declare(strict_types=1);
use \Madj2k\CatSearch\Utilities\TcaUtility;


$ll = 'LLL:EXT:cat_search/Resources/Private/Language/locallang_db.xlf:';
return [
    'ctrl' => [
        'title' => $ll .'tx_catsearch_domain_model_filterable',
        'label' => 'title',
        'label_userFunc' => \Madj2k\CatSearch\UserFunctions\FormEngine\Labels::class . '->labelFilterableTable',
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
        'iconfile' => 'EXT:cat_search/Resources/Public/Icons/tx_catsearch_domain_model_filterable.svg',
        'type' => 'record_type',
        'typeicon_column' => 'record_type',
        'typeicon_classes' => [
            'default' => 'catsearch-type-filterable-document',
            '2' => 'catsearch-type-filterable-product',
            '3' => 'catsearch-type-filterable-accessory',
        ],
    ],
    'types' => [
        // document
        '1' => [
            'showitem' => 'record_type,--palette--;;main_document,
            --div--;' . $ll . 'tab.seo,--palette--;;seo_document,
            --div--;' . $ll . 'tab.description,--palette--;;description_document,
            --div--;' . $ll . 'tab.content,--palette--;;content_document,
            --div--;' . $ll . 'tab.meta,--palette--;;meta_document,
            --div--;' . $ll . 'tab.relations,--palette--;;relations_document,
            --div--;' . $ll . 'tab.filter,--palette--;;filter_document,
            --div--;' . $ll . 'tab.media,--palette--;;media_document,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'
        ],
        // product
        '2' => [
            'showitem' => 'record_type,--palette--;;main_product,
            --div--;' . $ll . 'tab.seo,--palette--;;seo_product,
            --div--;' . $ll . 'tab.description,--palette--;;description_product,
            --div--;' . $ll . 'tab.description2,--palette--;;description2_product,
            --div--;' . $ll . 'tab.content,--palette--;;content_product,
            --div--;' . $ll . 'tab.meta,--palette--;;meta_product,
            --div--;' . $ll . 'tab.relations,--palette--;;relations_product,
            --div--;' . $ll . 'tab.filter,--palette--;;filter_product,
            --div--;' . $ll . 'tab.media,--palette--;;media_product,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'
        ],
        // accessory
        '3' => [
            'showitem' => 'record_type,--palette--;;main_accessory,
            --div--;' . $ll . 'tab.seo,--palette--;;seo_accessory,
            --div--;' . $ll . 'tab.description,--palette--;;description_accessory,
            --div--;' . $ll . 'tab.description2,--palette--;;description2_accessory,
            --div--;' . $ll . 'tab.content,--palette--;;content_accessory,
            --div--;' . $ll . 'tab.meta,--palette--;;meta_accessory,
            --div--;' . $ll . 'tab.relations,--palette--;;relations_accessory,
            --div--;' . $ll . 'tab.filter,--palette--;;filter_accessory,
            --div--;' . $ll . 'tab.media,--palette--;;media_accessory,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'
        ],
    ],
    'palettes' => [
        'main_document' => [
            'label' => $ll . 'palette.main',
            'showitem' => TcaUtility::removeFieldsByExtConf('document', '
                layout,
                --linebreak--,
				title,
				--linebreak--,
				title_cleaned,
				--linebreak--,
				subtitle,
				--linebreak--,
				overview_pid,
				--linebreak--,
				detail_pid
				'
            ),
        ],
        'main_product' => [
            'label' => $ll . 'palette.main',
            'showitem' => TcaUtility::removeFieldsByExtConf('product', '
                layout,
                --linebreak--,
				title,
				--linebreak--,
				title_cleaned,
				--linebreak--,
				subtitle,
				--linebreak--,
				overview_pid,
				--linebreak--,
				detail_pid
				'
            ),
        ],
        'main_accessory' => [
            'label' => $ll . 'palette.main',
            'showitem' => TcaUtility::removeFieldsByExtConf('accessory', '
                layout,
                --linebreak--,
				title,
				--linebreak--,
				title_cleaned,
				--linebreak--,
				subtitle,
				--linebreak--,
				overview_pid,
				--linebreak--,
				detail_pid
				'
            ),
        ],
        'filter_document' => [
            'label' => $ll . 'palette.filter',
            'showitem' => TcaUtility::removeFieldsByExtConf('document', '
                primary_filter1,
                --linebreak--,
                primary_filter2,
                --linebreak--,
                primary_filter3,
                --linebreak--,
                primary_filter4,
                --linebreak--,
                primary_filter5,
                --linebreak--,
				filters'
            ),
        ],
        'filter_product' => [
            'label' => $ll . 'palette.filter',
            'showitem' => TcaUtility::removeFieldsByExtConf('product', '
                primary_filter1,
                --linebreak--,
                primary_filter2,
                --linebreak--,
                primary_filter3,
                --linebreak--,
                primary_filter4,
                --linebreak--,
                primary_filter5,
                --linebreak--,
				filters'
            ),
        ],
        'filter_accessory' => [
            'label' => $ll . 'palette.filter',
            'showitem' => TcaUtility::removeFieldsByExtConf('accessory', '
                primary_filter1,
                --linebreak--,
                primary_filter2,
                --linebreak--,
                primary_filter3,
                --linebreak--,
                primary_filter4,
                --linebreak--,
                primary_filter5,
                --linebreak--,
				filters'
            ),
        ],
        'seo_document' => [
            'label' => $ll . 'palette.seo',
            'showitem' => TcaUtility::removeFieldsByExtConf('document', '
				slug,
                --linebreak--,
				title_seo,
				--linebreak--,
				description_seo'
            ),
        ],
        'seo_product' => [
            'label' => $ll . 'palette.seo',
            'showitem' => TcaUtility::removeFieldsByExtConf('product', '
				slug,
                --linebreak--,
				title_seo,
				--linebreak--,
				description_seo'
            ),
        ],
        'seo_accessory' => [
            'label' => $ll . 'palette.seo',
            'showitem' => TcaUtility::removeFieldsByExtConf('accessory', '
				slug,
                --linebreak--,
				title_seo,
				--linebreak--,
				description_seo'
            ),
        ],
        'description_document' => [
            'label' => $ll . 'palette.description',
            'showitem' => TcaUtility::removeFieldsByExtConf('document', '
				teaser,
				--linebreak--,
				description'
            ),
        ],
        'description_product' => [
            'label' => $ll . 'palette.description',
            'showitem' => TcaUtility::removeFieldsByExtConf('product', '
				teaser,
				--linebreak--,
				header,
                --linebreak--,
				subheader,
				--linebreak--,
				description,'
            )
        ],
        'description_accessory' => [
            'label' => $ll . 'palette.description',
            'showitem' => TcaUtility::removeFieldsByExtConf('accessory', '
				teaser,
				--linebreak--,
				header,
                --linebreak--,
				subheader,
				--linebreak--,
				description,'
            )
        ],
        'description2_product' => [
            'label' => $ll . 'palette.description2',
            'showitem' => TcaUtility::removeFieldsByExtConf('product', '
				header2,
                --linebreak--,
				subheader2,
                --linebreak--,
				description2,
				--linebreak--,
				header3,
                --linebreak--,
				subheader3,
				--linebreak--,
				description3'
            ),
        ],
        'description2_accessory' => [
            'label' => $ll . 'palette.description2',
            'showitem' => TcaUtility::removeFieldsByExtConf('accessory', '
				header2,
                --linebreak--,
				subheader2,
                --linebreak--,
				description2,
				--linebreak--,
				header3,
                --linebreak--,
				subheader3,
				--linebreak--,
				description3'
            ),
        ],
        'content_document' => [
            'label' => $ll . 'palette.content',
            'showitem' => TcaUtility::removeFieldsByExtConf('document', '
				content_elements'
            ),
        ],
        'content_product' => [
            'label' => $ll . 'palette.content',
            'showitem' => TcaUtility::removeFieldsByExtConf('product', '
				content_elements'
            ),
        ],
        'content_accessory' => [
            'label' => $ll . 'palette.content',
            'showitem' => TcaUtility::removeFieldsByExtConf('accessory', '
				content_elements'
            ),
        ],
        'meta_document' => [
            'label' => $ll . 'palette.meta',
            'showitem' => TcaUtility::removeFieldsByExtConf('document', '
				publish_date,
				 --linebreak--,
                manufacturer,'
            ),
        ],
        'meta_product' => [
            'label' => $ll . 'palette.meta',
            'showitem' => TcaUtility::removeFieldsByExtConf('product', '
				publish_date,
                --linebreak--,
                product_number,
                --linebreak--,
                manufacturer,
                --linebreak--,
				highlights,
				--linebreak--,
				features,
				--linebreak--,
				options,
				--linebreak--,
				applications,
				--linebreak--,
				details,
				--linebreak--,
				detail_image'
            ),
        ],
        'meta_accessory' => [
            'label' => $ll . 'palette.meta',
            'showitem' => TcaUtility::removeFieldsByExtConf('accessory', '
				publish_date,
                --linebreak--,
                product_number,
                --linebreak--,
                manufacturer,
                --linebreak--,
				highlights,
				--linebreak--,
				features,
				--linebreak--,
				options,
				--linebreak--,
				applications,
				--linebreak--,
				details,
				--linebreak--,
				detail_image'
            ),
        ],
        'media_document' => [
            'label' => $ll . 'palette.media',
            'showitem' => TcaUtility::removeFieldsByExtConf('document', '
                teaser_image,
                --linebreak--,
				download'
            ),
        ],
        'media_product' => [
            'label' => $ll . 'palette.media',
            'showitem' => TcaUtility::removeFieldsByExtConf('product', '
                teaser_image,
                --linebreak--,
                main_image,
                --linebreak--,
                images,
                --linebreak--,
				downloads,
				--linebreak--,
				data_sheets,
				--linebreak--,
				media_files'
            ),
        ],
        'media_accessory' => [
            'label' => $ll . 'palette.media',
            'showitem' => TcaUtility::removeFieldsByExtConf('accessory', '
                teaser_image,
                --linebreak--,
                main_image,
                --linebreak--,
                images,
                --linebreak--,
				downloads,
				--linebreak--,
				data_sheets,
				--linebreak--,
				media_files'
            ),
        ],
        'relations_document' => [
            'label' => $ll . 'palette.relations',
            'showitem' => TcaUtility::removeFieldsByExtConf('document', '
				publish_date,
                --linebreak--,
				related_filterable_products'
            ),
        ],
        'relations_product' => [
            'label' => $ll . 'palette.relations',
            'showitem' => TcaUtility::removeFieldsByExtConf('product', '
				related_filterable_accessories,
				--linebreak--,
				related_filterable_documents'
            ),
        ],
        'relations_accessory' => [
            'label' => $ll . 'palette.relations',
            'showitem' => TcaUtility::removeFieldsByExtConf('accessory', '
				related_filterable_products2,
				--linebreak--,
				related_filterable_documents'
            ),
        ],
    ],
    'columns' => [
        'crdate' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'tstamp' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => false,
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
            'exclude' => false,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_catsearch_domain_model_filterable',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filterable}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filterable}.{#sys_language_uid} IN (-1,0)',
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
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'record_type' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll . 'tx_catsearch_domain_model_filterable.record_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => $ll . 'tx_catsearch_domain_model_filterable.record_type.1',
                        'value' => 1,
                        'icon' => 'catsearch-type-filterable-document'
                    ],
                    [
                        'label' => $ll . 'tx_catsearch_domain_model_filterable.record_type.2',
                        'value' => 2,
                        'icon' => 'catsearch-type-filterable-product'
                    ],
                    [
                        'label' => $ll . 'tx_catsearch_domain_model_filterable.record_type.3',
                        'value' => 3,
                        'icon' => 'catsearch-type-filterable-accessory'
                    ],
                ],
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => false,
                    ],
                ],
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'layout' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll . 'tx_catsearch_domain_model_filterable.layout',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => $ll . 'tx_catsearch_domain_model_filterable.layout.default',
                        'value' => 'default',
                    ],
                    [
                        'label' => $ll . 'tx_catsearch_domain_model_filterable.layout.big',
                        'value' => 'big',
                    ],
                ],
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'detail_pid' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.detail_pid',
            'config' => [
                'type' => 'group',
                'size' => 1,
                'allowed' => 'pages',
                'foreign_table' => 'pages',
                'foreign_table_where' => 'AND {#pages}.{#sys_language_uid} IN (-1, 0) AND {#pages}.{#hidden} = 0 AND {#pages}.{#deleted} = 0 ORDER BY pages.title',
                'minitems' => 0,
                'maxitems' => 1
            ],
        ],
        'overview_pid' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.overview_pid',
            'config' => [
                'type' => 'group',
                'size' => 1,
                'allowed' => 'pages',
                'foreign_table' => 'pages',
                'foreign_table_where' => 'AND {#pages}.{#sys_language_uid} IN (-1, 0) AND {#pages}.{#hidden} = 0 AND {#pages}.{#deleted} = 0 ORDER BY pages.title',
                'minitems' => 0,
                'maxitems' => 1
            ],
        ],
        'title' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ]
        ],
        'title_cleaned' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.title_cleaned',
            'config' => [
                'readOnly' => true,
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ]
        ],
        'title_seo' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.title_seo',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ]
        ],
        'subtitle' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.subtitle',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ]
        ],
        'teaser' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.teaser',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 10,
                'eval' => 'trim',
            ],
        ],
        'header' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.header',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ]
        ],
        'header2' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.header2',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ]
        ],
        'header3' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.header3',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ]
        ],
        'subheader' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.subheader',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ]
        ],
        'subheader2' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.subheader2',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ]
        ],
        'subheader3' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.subheader3',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ]
        ],
        'description' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 10,
                'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
        'description_seo' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.description_seo',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 10,
                'eval' => 'trim',
            ],
        ],
        'description2' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.description2',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 10,
                'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
        'description3' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.description3',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 10,
                'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
        'features' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.features',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 10,
                'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
        'options' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.options',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 10,
                'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
        'applications' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.applications',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 10,
                'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
        'highlights' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.highlights',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 10,
                'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
        'details' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.details',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 10,
                'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
        'product_number' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.product_number',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ]
        ],
        'publish_date' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.publish_date',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,required',
                'default' => time()
            ],
        ],
        'slug' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.slug',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['title_cleaned'],
                    'fieldSeparator' => '-',
                    'replacements' => [
                        '/' => '-'
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => '',
            ],
        ],
        'manufacturer' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.manufacturer',
            'config' => [
                'type' => 'group',
                'size' => 1,
                'allowed' => 'tx_catsearch_domain_model_manufacturer',
                'foreign_table' => 'tx_catsearch_domain_model_manufacturer',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_manufacturer}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_manufacturer}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_manufacturer}.{#hidden} = 0 AND {#tx_catsearch_domain_model_manufacturer}.{#deleted} = 0 ORDER BY {#tx_catsearch_domain_model_manufacturer}.{#title}',
                'minitems' => 0,
                'maxitems' => 1
            ],
        ],
        'teaser_image' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.teaser_image',
            'config' => [
                'type' => 'file',
                'allowed' => ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp'],
                'maxitems' => 1,
            ],
        ],
        'main_image' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.main_image',
            'config' => [
                'type' => 'file',
                'allowed' => ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp'],
                'maxitems' => 1,
            ],
        ],
        'detail_image' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.detail_image',
            'config' => [
                'type' => 'file',
                'allowed' => ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp'],
                'maxitems' => 1,
            ],
        ],
        'images' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.images',
            'config' => [
                'type' => 'file',
                'allowed' => ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp'],
                'maxitems' => 9999,
            ],
        ],
        'download' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.download',
            'config' => [
                'type' => 'file',
                'allowed' => ['pdf,doc,docx,xls,xlsx,ppt,pptx,zip'],
                'maxitems' => 1,
                'minitems' => 1,
            ]
        ],
        'downloads' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.downloads',
            'config' => [
                'type' => 'file',
                'allowed' => ['pdf,doc,docx,xls,xlsx,ppt,pptx,zip'],
                'maxitems' => 9999,
            ]
        ],
        'data_sheets' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.data_sheets',
            'config' => [
                'type' => 'file',
                'allowed' => ['pdf,doc,docx,xls,xlsx,ppt,pptx,zip'],
                'maxitems' => 9999,
            ]
        ],
        'media_files' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.media_files',
            'config' => [
                'type' => 'file',
                'allowed' => ['youtube,vimeo,gif'],
                'maxitems' => 9999,
            ]
        ],
        'related_filterables' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.related_filterables',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filterable',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filterable}.{#uid} != ###REC_FIELD_uid### AND {#tx_catsearch_domain_model_filterable}.{#record_type} = ###REC_FIELD_record_type### AND {#tx_catsearch_domain_model_filterable}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filterable}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_filterable}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filterable}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
                'MM' => 'tx_catsearch_filterable_filterable_mm',
                'MM_opposite_field' => 'related_filterables_from',
                'minitems' => 0
            ],
        ],
        'related_filterables_from' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.related_filterables_from',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filterable',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filterable}.{#uid} != ###REC_FIELD_uid### AND {#tx_catsearch_domain_model_filterable}.{#record_type} = ###REC_FIELD_record_type### AND {#tx_catsearch_domain_model_filterable}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filterable}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_filterable}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filterable}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
                'MM' => 'tx_catsearch_filterable_filterable_mm',
                'readOnly' => 1,
            ],
        ],
        'related_filterable_documents' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.related_filterable_documents',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filterable',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filterable}.{#uid} != ###REC_FIELD_uid### AND {#tx_catsearch_domain_model_filterable}.{#record_type} = 1 AND {#tx_catsearch_domain_model_filterable}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filterable}.{#sys_language_uid} IN (-1, ###REC_FIELD_sys_language_uid###) AND {#tx_catsearch_domain_model_filterable}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filterable}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
                'MM' => 'tx_catsearch_filterableproduct_filterabledocuments_mm',
                'MM_opposite_field' => 'related_filterable_products',
                'minitems' => 0
            ],
        ],
        'related_filterable_products' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.related_filterable_products',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filterable',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filterable}.{#uid} != ###REC_FIELD_uid### AND {#tx_catsearch_domain_model_filterable}.{#record_type} = 2 AND {#tx_catsearch_domain_model_filterable}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filterable}.{#sys_language_uid} IN (-1, ###REC_FIELD_sys_language_uid###) AND {#tx_catsearch_domain_model_filterable}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filterable}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
                'MM' => 'tx_catsearch_filterableproduct_filterabledocuments_mm',
                'minitems' => 0,
            ],
        ],
        'related_filterable_accessories' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.related_filterable_accessories',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filterable',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filterable}.{#uid} != ###REC_FIELD_uid### AND {#tx_catsearch_domain_model_filterable}.{#record_type} = 3 AND {#tx_catsearch_domain_model_filterable}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filterable}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_filterable}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filterable}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
                'MM' => 'tx_catsearch_filterableproduct_filterableaccessories_mm',
                'MM_opposite_field' => 'related_filterable_products2',
                'minitems' => 0
            ],
        ],
        'related_filterable_products2' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.related_filterable_products',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filterable',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filterable}.{#uid} != ###REC_FIELD_uid### AND {#tx_catsearch_domain_model_filterable}.{#record_type} = 2 AND {#tx_catsearch_domain_model_filterable}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filterable}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_filterable}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filterable}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
                'MM' => 'tx_catsearch_filterableproduct_filterableaccessories_mm',
                'minitems' => 0
            ],
        ],
        'filters' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.filters',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filter',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filter}.{#type} NOT IN(' . (TcaUtility::getPrimaryFiltersByExtConf() ? implode(',', TcaUtility::getPrimaryFiltersByExtConf()) : -1). ') AND {#tx_catsearch_domain_model_filter}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filter}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_filter}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filter}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filter.title',
                'MM' => 'tx_catsearch_filterable_filter_mm',
                'minitems' => 0
            ],
        ],
        'primary_filter1' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.primary_filter1',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filter',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filter}.{#type} =' . (TcaUtility::getPrimaryFilterByExtConf(1) ? TcaUtility::getPrimaryFilterByExtConf(1) : -1). ' AND {#tx_catsearch_domain_model_filter}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filter}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_filter}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filter}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filter.title',
                'minitems' => 0,
                'maxitems' => 1
            ],
        ],
        'primary_filter2' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.primary_filter2',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filter',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filter}.{#type} =' . (TcaUtility::getPrimaryFilterByExtConf(2) ? TcaUtility::getPrimaryFilterByExtConf(2) : -1) . ' AND {#tx_catsearch_domain_model_filter}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filter}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_filter}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filter}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filter.title',
                'minitems' => 0,
                'maxitems' => 1
            ],
        ],
        'primary_filter3' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.primary_filter3',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filter',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filter}.{#type} =' . (TcaUtility::getPrimaryFilterByExtConf(3) ? TcaUtility::getPrimaryFilterByExtConf(3) : -1) . ' AND {#tx_catsearch_domain_model_filter}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filter}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_filter}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filter}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filter.title',
                'minitems' => 0,
                'maxitems' => 1
            ],
        ],
        'primary_filter4' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.primary_filter4',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filter',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filter}.{#type} =' . (TcaUtility::getPrimaryFilterByExtConf(4) ? TcaUtility::getPrimaryFilterByExtConf(4) : -1) . ' AND {#tx_catsearch_domain_model_filter}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filter}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_filter}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filter}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filter.title',
                'minitems' => 0,
                'maxitems' => 1
            ],
        ],
        'primary_filter5' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.primary_filter5',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filter',
                'foreign_table_where' => 'AND {#tx_catsearch_domain_model_filter}.{#type} =' . (TcaUtility::getPrimaryFilterByExtConf(5) ? TcaUtility::getPrimaryFilterByExtConf(5) : -1) . ' AND {#tx_catsearch_domain_model_filter}.{#pid}=###CURRENT_PID### AND {#tx_catsearch_domain_model_filter}.{#sys_language_uid} IN (-1, 0) AND {#tx_catsearch_domain_model_filter}.{#hidden} = 0 AND {#tx_catsearch_domain_model_filter}.{#deleted} = 0 ORDER BY tx_catsearch_domain_model_filter.title',
                'minitems' => 0,
                'maxitems' => 1
            ],
        ],
        'content_elements' => [
            'exclude' => false,
            'label' => $ll .'tx_catsearch_domain_model_filterable.content_elements',
            'config' => [
                'type' => 'inline',
                'allowed' => 'tt_content',
                'foreign_table' => 'tt_content',
                'foreign_sortby' => 'sorting',
                'foreign_field' => 'tx_catsearch_content_element',
                'minitems' => 0,
                'maxitems' => 99,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                    'enabledControls' => [
                        'info' => false,
                    ],
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'CType' => [
                            'config' => [
                                'itemsProcFunc' => Madj2k\CatSearch\UserFunctions\FormEngine\CTypeSelectItemProcFunc::class . '->itemsProcFunc',
                            ]
                        ]
                    ]
                ]
            ],
        ],
        'publish_date_year' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'content_index' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'content_index_tstamp' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ]

    ],
];

