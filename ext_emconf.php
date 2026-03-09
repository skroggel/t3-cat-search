<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'CatSearch',
	'description' => 'This extensions allows you to tag data-sets with categories and search for them',
	'category' => 'plugin',
	'author' => 'Steffen Kroggel',
	'author_email' => 'developer@steffenkroggel.de',
	'state' => 'stable',
	'version' => '13.4.1',
	'constraints' => [
		'depends' => [
            'typo3' => '13.4.0-13.4.99',
        ],
		'conflicts' => [
		],
		'suggests' => [
        ],
	],
];
