<?php
// Add you own indexer to the array, use a comma to join more indexers.
$GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['sysfolder']['displayCond'] .= ',' . \Madj2k\CatSearch\Hooks\KeSearch\ProductIndexer::KEY;
$GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['sysfolder']['displayCond'] .= ',' . \Madj2k\CatSearch\Hooks\KeSearch\DocumentIndexer::KEY;
$GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['sysfolder']['displayCond'] .= ',' . \Madj2k\CatSearch\Hooks\KeSearch\AccessoryIndexer::KEY;
