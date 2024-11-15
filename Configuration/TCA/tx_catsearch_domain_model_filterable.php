<?php
$ll = 'LLL:EXT:cat_search/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title' => $ll .'tx_catsearch_domain_model_filterable',
        'label' => 'title',
        'label_alt' => 'subtitle, language',
        'label_alt_force' => true,
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
            --div--;' . $ll . 'tab.description,--palette--;;description_document,
            --div--;' . $ll . 'tab.meta,--palette--;;meta_document,
            --div--;' . $ll . 'tab.relations,--palette--;;relations_document,
            --div--;' . $ll . 'tab.filter,--palette--;;filter,
            --div--;' . $ll . 'tab.media,--palette--;;media_document,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'
        ],
        // product
        '2' => [
            'showitem' => 'record_type,--palette--;;main_product,
            --div--;' . $ll . 'tab.description,--palette--;;description_product,
            --div--;' . $ll . 'tab.description2,--palette--;;description2_product,
            --div--;' . $ll . 'tab.meta,--palette--;;meta_product,
            --div--;' . $ll . 'tab.relations,--palette--;;relations_product,
            --div--;' . $ll . 'tab.filter,--palette--;;filter,
            --div--;' . $ll . 'tab.media,--palette--;;media_product,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'
        ],
        // accessory
        '3' => [
            'showitem' => 'record_type,--palette--;;main_product,
            --div--;' . $ll . 'tab.description,--palette--;;description_product,
            --div--;' . $ll . 'tab.meta,--palette--;;meta_product,
            --div--;' . $ll . 'tab.relations,--palette--;;relations_accessory,
            --div--;' . $ll . 'tab.filter,--palette--;;filter,
            --div--;' . $ll . 'tab.media,--palette--;;media_product,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'
        ],
    ],
    'palettes' => [
        'main_document' => [
            'label' => $ll . 'palette.main',
            'showitem' => '
                sub_type,
                --linebreak--,
				title,
				--linebreak--,
				title_cleaned,
				--linebreak--,
				title_seo,
				--linebreak--,
				subtitle,
				',
        ],
        'main_product' => [
            'label' => $ll . 'palette.main',
            'showitem' => '
                sub_type,
                --linebreak--,
				title,
				--linebreak--,
				title_cleaned,
				--linebreak--,
				title_seo,
				--linebreak--,
				slug,
				--linebreak--,
				subtitle,
				',
        ],
        'filter' => [
            'label' => $ll . 'palette.filter',
            'showitem' => '
				filters',
        ],
        'description_document' => [
            'label' => $ll . 'palette.description',
            'showitem' => '
				teaser,
				--linebreak--,
				description',
        ],
        'description_product' => [
            'label' => $ll . 'palette.description',
            'showitem' => '
				teaser,
				--linebreak--,
				header,
                --linebreak--,
				subheader,
				--linebreak--,
				description,'
        ],
        'description2_product' => [
            'label' => $ll . 'palette.description2',
            'showitem' => '
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
				description3',
        ],
        'meta_document' => [
            'label' => $ll . 'palette.meta',
            'showitem' => '
				publish_date,
				 --linebreak--,
				language,',
        ],
        'meta_product' => [
            'label' => $ll . 'palette.meta',
            'showitem' => '
				publish_date,
                --linebreak--,
                product_number,
                --linebreak--,
				highlights,
				--linebreak--,
				features,
				--linebreak--,
				options,
				--linebreak--,
				applications,
				--linebreak--,
				details',
        ],
        'media_document' => [
            'label' => $ll . 'palette.media',
            'showitem' => '
                teaser_image,
                --linebreak--,
				download',
        ],
        'media_product' => [
            'label' => $ll . 'palette.media',
            'showitem' => '
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
				media_files',
        ],
        'relations_document' => [
            'label' => $ll . 'palette.relations',
            'showitem' => '
				publish_date,
                --linebreak--,
				related_filterable_products',
        ],
        'relations_product' => [
            'label' => $ll . 'palette.relations',
            'showitem' => '
				related_filterable_accessories,
				--linebreak--,
				related_filterable_documents',
        ],
        'relations_accessory' => [
            'label' => $ll . 'palette.relations',
            'showitem' => '
				related_filterable_products2,
				--linebreak--,
				related_filterable_documents',
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
                'foreign_table' => 'tx_catsearch_domain_model_filterable',
                'foreign_table_where' => 'AND tx_catsearch_domain_model_filterable.pid=###CURRENT_PID### AND tx_catsearch_domain_model_filterable.sys_language_uid IN (-1,0)',
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
        'sub_type' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll . 'tx_catsearch_domain_model_filterable.sub_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => $ll . 'tx_catsearch_domain_model_filterable.sub_type.0',
                        'value' => 0,
                    ],
                ],
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'language' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll . 'tx_catsearch_domain_model_filterable.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => $ll . 'tx_catsearch_domain_model_filterable.language.0',
                        'value' => 0,
                    ],
                ],
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 1,
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
            'exclude' => true,
            'label' => $ll .'tx_catsearch_domain_model_filterable.header2',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ]
        ],
        'header3' => [
            'exclude' => true,
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
        'description2' => [
            'exclude' => true,
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
            'exclude' => true,
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
                'foreign_table_where' => 'AND tx_catsearch_domain_model_filterable.uid != ###REC_FIELD_uid### AND tx_catsearch_domain_model_filterable.record_type = ###REC_FIELD_record_type### AND tx_catsearch_domain_model_filterable.pid=###CURRENT_PID### AND tx_catsearch_domain_model_filterable.sys_language_uid IN (-1, 0) AND tx_catsearch_domain_model_filterable.hidden = 0 AND tx_catsearch_domain_model_filterable.deleted = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
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
                'foreign_table_where' => 'AND tx_catsearch_domain_model_filterable.uid != ###REC_FIELD_uid### AND tx_catsearch_domain_model_filterable.record_type = ###REC_FIELD_record_type### AND tx_catsearch_domain_model_filterable.pid=###CURRENT_PID### AND tx_catsearch_domain_model_filterable.sys_language_uid IN (-1, 0) AND tx_catsearch_domain_model_filterable.hidden = 0 AND tx_catsearch_domain_model_filterable.deleted = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
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
                'foreign_table_where' => 'AND tx_catsearch_domain_model_filterable.uid != ###REC_FIELD_uid### AND tx_catsearch_domain_model_filterable.record_type = 1 AND tx_catsearch_domain_model_filterable.pid=###CURRENT_PID### AND tx_catsearch_domain_model_filterable.sys_language_uid IN (-1, ###REC_FIELD_sys_language_uid###) AND tx_catsearch_domain_model_filterable.hidden = 0 AND tx_catsearch_domain_model_filterable.deleted = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
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
                'foreign_table_where' => 'AND tx_catsearch_domain_model_filterable.uid != ###REC_FIELD_uid### AND tx_catsearch_domain_model_filterable.record_type = 2 AND tx_catsearch_domain_model_filterable.pid=###CURRENT_PID### AND tx_catsearch_domain_model_filterable.sys_language_uid IN (-1, ###REC_FIELD_sys_language_uid###) AND tx_catsearch_domain_model_filterable.hidden = 0 AND tx_catsearch_domain_model_filterable.deleted = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
                'MM' => 'tx_catsearch_filterableproduct_filterabledocuments_mm',
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
                'foreign_table_where' => 'AND tx_catsearch_domain_model_filterable.uid != ###REC_FIELD_uid### AND tx_catsearch_domain_model_filterable.record_type = 2 AND tx_catsearch_domain_model_filterable.pid=###CURRENT_PID### AND tx_catsearch_domain_model_filterable.sys_language_uid IN (-1, 0) AND tx_catsearch_domain_model_filterable.hidden = 0 AND tx_catsearch_domain_model_filterable.deleted = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
                'MM' => 'tx_catsearch_filterableproduct_filterableaccessories_mm',
                'minitems' => 0
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
                'foreign_table_where' => 'AND tx_catsearch_domain_model_filterable.uid != ###REC_FIELD_uid### AND tx_catsearch_domain_model_filterable.record_type = 3 AND tx_catsearch_domain_model_filterable.pid=###CURRENT_PID### AND tx_catsearch_domain_model_filterable.sys_language_uid IN (-1, 0) AND tx_catsearch_domain_model_filterable.hidden = 0 AND tx_catsearch_domain_model_filterable.deleted = 0 ORDER BY tx_catsearch_domain_model_filterable.title',
                'MM' => 'tx_catsearch_filterableproduct_filterableaccessories_mm',
                'MM_opposite_field' => 'related_filterable_products2',
                'minitems' => 0
            ],
        ],
        'filters' => [
            'exclude' => false,
            'l10n_mode' => 'exclude',
            'label' => $ll .'tx_catsearch_domain_model_filterable.filters',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_catsearch_domain_model_filter',
                'foreign_table_where' => 'AND tx_catsearch_domain_model_filter.pid=###CURRENT_PID### AND tx_catsearch_domain_model_filter.sys_language_uid IN (-1, 0) AND tx_catsearch_domain_model_filter.hidden = 0 AND tx_catsearch_domain_model_filter.deleted = 0 ORDER BY tx_catsearch_domain_model_filter.title',
                'MM' => 'tx_catsearch_filterable_filter_mm',
                'minitems' => 0
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

