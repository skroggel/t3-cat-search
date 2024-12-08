<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\Hooks\KeSearch;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Tpwd\KeSearch\Indexer\IndexerBase;
use Tpwd\KeSearch\Indexer\IndexerRunner;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class AbstractIndexer
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

if (class_exists(\Tpwd\KeSearch\Indexer\IndexerBase::class)) {
    abstract class AbstractIndexer extends IndexerBase
    {

        /**
         * @const string
         */
        const TABLE_FILTER_OPTIONS = 'tx_kesearch_filteroptions';


        // Set a key for your indexer configuration.
        // Add this key to the $GLOBALS[...] array in Configuration/TCA/Overrides/tx_kesearch_indexerconfig.php, too!
        // It is recommended (but no must) to use the name of the table you are going to index as a key because this
        // gives you the "original row" to work with in the result list template.
        /**
         * @const string
         */
        const KEY = 'catsearch_product';


        /**
         * @const string
         */
        const TABLE = 'tx_catsearch_domain_model_filterable';


        /**
         * @const string
         */
        const RECORD_TYPE_STRING = 'product';


        /**
         * @const int
         */
        const RECORD_TYPE = 2;


        /**
         * Adds the custom indexer to the TCA of indexer configurations, so that
         * it's selectable in the backend as an indexer type, when you create a
         * new indexer configuration.
         *
         * @param array $params
         * @param object $pObj
         * @return void
         */
        public function registerIndexerConfiguration(array &$params, object $pObj): void
        {
            // Set a name and an icon for your indexer.
            $customIndexer = array(
                ucfirst(static::RECORD_TYPE_STRING) . ' (CatSearch)',
                static::KEY,
                'EXT:cat_search/Resources/Public/Icons/Extension.svg'
            );
            $params['items'][] = $customIndexer;
        }


        /**
         * Custom indexer for ke_search.
         *
         * @param array $indexerConfig Configuration from TYPO3 Backend.
         * @param \Tpwd\KeSearch\Indexer\IndexerRunner $indexerObject Reference to indexer class.
         * @return  string Message containing indexed elements.
         * @throws \Doctrine\DBAL\Exception
         * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException
         * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException
         */
        public function customIndexer(array &$indexerConfig, IndexerRunner &$indexerObject): string
        {
            if ($indexerConfig['type'] == static::KEY) {
                $table = static::TABLE;

                // Doctrine DBAL using Connection Pool.
                /** @var Connection $connection */
                $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($table);

                /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilder */
                $queryBuilder = $connection->createQueryBuilder();

                // Handle restrictions.
                // Don't fetch hidden or deleted elements, but the elements
                // with frontend user group access restrictions or time (start / stop)
                // restrictions in order to copy those restrictions to the index.
                $queryBuilder
                    ->getRestrictions()
                    ->removeAll()
                    ->add(GeneralUtility::makeInstance(DeletedRestriction::class))
                    ->add(GeneralUtility::makeInstance(HiddenRestriction::class));

                $folders = GeneralUtility::trimExplode(',', htmlentities($indexerConfig['sysfolder']));
                $statement = $queryBuilder
                    ->select('uid', 'pid', 'tstamp', 'sys_language_uid', 'starttime', 'endtime', 'record_type',
                        'publish_date', 'detail_pid', 'overview_pid', 'title_cleaned', 'subtitle', 'header', 'subheader',
                        'teaser', 'content_index', 'teaser_image', 'download')
                    ->from($table)
                    ->where(
                        $queryBuilder->expr()->and(
                            $queryBuilder->expr()->in( 'pid', $folders),
                            $queryBuilder->expr()->eq(
                                'record_type',
                                $queryBuilder->createNamedParameter(static::RECORD_TYPE, \PDO::PARAM_INT)
                            )
                        )
                    )
                    ->executeQuery();

                // Loop through the records and write them to the index.
                $counter = 0;
                while ($record = $statement->fetchAssociative()) {

                    // tags:  #example_tag_1#,#example_tag_2#
                    // If you use Sphinx, use "_" instead of "#" (configurable in the extension manager).
                    $tags = '';
                    if (!empty($indexerConfig['filteroption'])) {

                        /** @var Connection $connectionTags */
                        $connectionTags = GeneralUtility::makeInstance(ConnectionPool::class)
                            ->getConnectionForTable(static::TABLE_FILTER_OPTIONS);

                        /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $queryBuilderTags */
                        $queryBuilderTags = $connectionTags->createQueryBuilder();
                        $statementTags = $queryBuilderTags
                            ->select('uid', 'tag')
                            ->from(static::TABLE_FILTER_OPTIONS)
                            ->where(
                                $queryBuilderTags->expr()->eq( 'uid', (int) $indexerConfig['filteroption']),
                            )
                            ->executeQuery();

                        if ($result = $statementTags->fetchAssociative()) {
                            $tags = '#' . $result['tag'] . '#';
                        }
                    }

                    // Additional information
                    $additionalFields = array(
                        'orig_uid' => $record['uid'],
                        'orig_pid' => $record['pid'],
                        'detail_pid' => $record['detail_pid'],
                        'overview_pid' => $record['overview_pid'],
                        'sortdate' => $record['publish_date'],
                        'subtitle' => $record['subtitle'],
                        'header' => $record['header'],
                        'subheader' => $record['subheader'],
                        'teaser_image' => $record['teaser_image'],
                        'download' => $record['download'],
                    );

                    // ... and store the information in the index
                    $indexerObject->storeInIndex(
                        $indexerConfig['storagepid'],                               // storage PID
                        $this->getTitle($record),                                   // record title
                        static::TABLE,                                         // content type
                        ($record['detail_pid'] ?: $indexerConfig['targetpid']),     // target PID: where is the single view?
                        $this->getContent($record),                                 // indexed content, includes the title (linebreak after title)
                        $tags,                                                      // tags for faceted search
                        $this->getDetailParams($record),                            // typolink params for singleview
                        $this->getAbstract($record),                                // abstract; shown in result list if not empty
                        $record['sys_language_uid'],                                // language uid
                        $record['starttime'],                                       // starttime
                        $record['endtime'],                                         // endtime
                        '',                                                 // fe_group
                        false,                                            // debug only?
                        $additionalFields                                           // additionalFields
                    );

                    $counter++;
                }

                return $counter . ' Elements have been indexed.';
            }
            return '';
        }


        /**
         * Get the title
         *
         * @param array $record
         * @return string
         */
        protected function getTitle (array $record): string
        {
            return $record['title_cleaned'] ?: '';
        }


        /**
         * Get the abstract
         *
         * @param array $record
         * @return string
         */
        protected function getAbstract (array $record): string
        {
            return $record['teaser'] ?: ($record['subtitle']?: '');
        }


        /**
         * Get the content
         *
         * @param array $record
         * @return string
         */
        protected function getContent (array $record): string
        {
            return $this->getTitle($record) . "\n" .  $this->getAbstract($record) . "\n" . $record['content_index'];
        }


        /**
         * Get the detail params
         *
         * @param array $record
         * @return string
         */
        protected function getDetailParams (array $record): string
        {
            return '&tx_catsearch_detail[item]=' . $record['uid'];
        }

    }
}else {
    abstract class AbstractIndexer {
        // nothing here
    }
}

