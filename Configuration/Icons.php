<?php
declare(strict_types=1);
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

$iconList = [];
foreach ([
    'catsearch-plugin-search' => 'tx_catsearch_search.svg',
    'catsearch-type-filterable-product' => 'tx_catsearch_domain_model_filterable_product.svg',
    'catsearch-type-filterable-document' => 'tx_catsearch_domain_model_filterable_document.svg',
] as $identifier => $path) {
    $iconList[$identifier] = [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:cat_search/Resources/Public/Icons/' . $path,
    ];
}

return $iconList;
