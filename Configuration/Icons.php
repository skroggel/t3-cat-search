<?php
declare(strict_types=1);
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

$iconList = [];
foreach ([
    'catsearch-plugin-search' => 'tx_catsearch_search.svg',
    'catsearch-plugin-searchrelated' => 'tx_catsearch_searchrelated.svg',
    'catsearch-plugin-detail' => 'tx_catsearch_detail.svg',
    'catsearch-plugin-teaserfiltered' => 'tx_catsearch_teaserfiltered.svg',
    'catsearch-type-filterable-product' => 'tx_catsearch_domain_model_filterable_product.svg',
    'catsearch-type-filterable-accessory' => 'tx_catsearch_domain_model_filterable_accessory.svg',
    'catsearch-type-filterable-document' => 'tx_catsearch_domain_model_filterable_document.svg',
] as $identifier => $path) {
    $iconList[$identifier] = [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cat_search/Resources/Public/Icons/' . $path,
    ];
}

return $iconList;
