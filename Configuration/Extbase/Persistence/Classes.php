<?php
declare(strict_types=1);

return [
    \Madj2k\CatSearch\Domain\Model\Filterable::class => [
        'subclasses' => [
            1 => \Madj2k\CatSearch\Domain\Model\FilterableDocument::class,
            2 => \Madj2k\CatSearch\Domain\Model\FilterableProduct::class,
            3 => \Madj2k\CatSearch\Domain\Model\FilterableAccessory::class,
        ],
    ],
    \Madj2k\CatSearch\Domain\Model\FilterableDocument::class => [
        'tableName' => 'tx_catsearch_domain_model_filterable',
        'recordType' => 1,
    ],
    \Madj2k\CatSearch\Domain\Model\FilterableProduct::class => [
        'tableName' => 'tx_catsearch_domain_model_filterable',
        'recordType' => 2,
    ],
    \Madj2k\CatSearch\Domain\Model\FilterableAccessory::class => [
        'tableName' => 'tx_catsearch_domain_model_filterable',
        'recordType' => 3,
    ],
    \Madj2k\CatSearch\Domain\Model\TtContent::class => [
        'tableName' => 'tt_content',
        'properties' => [
            'altText' => [
                'fieldName' => 'altText',
            ],
            'titleText' => [
                'fieldName' => 'titleText',
            ],
            'colPos' => [
                'fieldName' => 'colPos',
            ],
            'CType' => [
                'fieldName' => 'CType',
            ],
        ],
    ],
];
