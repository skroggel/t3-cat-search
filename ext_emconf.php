<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'CatSearch',
	'description' => 'This extensions allows you to tag data-sets with categories and search for them',
	'category' => 'plugin',
	'author' => 'Steffen Kroggel',
	'author_email' => 'developer@steffenkroggel.de',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '0',
	'clearCacheOnLoad' => 0,
	'version' => '12.4.30',
	'constraints' => [
		'depends' => [
            'typo3' => '12.4.0-12.4.99',
        ],
		'conflicts' => [
		],
		'suggests' => [
        ],
	],
];
