<?php
use Madj2k\CatSearch\Hooks\KeSearch\ProductIndexer;
use Madj2k\CatSearch\Hooks\KeSearch\DocumentIndexer;
use Madj2k\CatSearch\Hooks\KeSearch\AccessoryIndexer;

// Add you own indexer to the array, use a comma to join more indexers.
$GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['sysfolder']['displayCond'] .= ',' . ProductIndexer::KEY;
$GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['sysfolder']['displayCond'] .= ',' . DocumentIndexer::KEY;
$GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['sysfolder']['displayCond'] .= ',' . AccessoryIndexer::KEY;
