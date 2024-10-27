<?php
defined('TYPO3') or die('Access denied.');

call_user_func(
	function($extensionKey)
	{

		foreach(['Search'] as $plugin) {
			$pluginSignature = \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
				$extensionKey,
				$plugin,
				'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_be.xlf:plugin.tx_catsearch_' . strtolower($plugin) . '.title',
				'catsearch-plugin-' . strtolower($plugin)
			);
			$pluginList[] = $pluginSignature;

			$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
				$pluginSignature,
				'FILE:EXT:' . $extensionKey . '/Configuration/FlexForms/' . $plugin . '.xml'
			);
		}


		/**
		 * Remove fields from plugins, that we don't need here
		 */
		if (! is_array ($GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'])) {
			$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'] = [];
		}

		$excludeList = 'header,header_layout,header_position,header_link,date,subheader,layout,frame_class,space_before_class,space_after_class,sectionIndex,linkToTop,recursive';
		// $excludeList .= ',pages';
		foreach ($pluginList as $plugin) {
			$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'] = array_merge(
				$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'],
				[
					$plugin => $excludeList,
				]
			);
		}

	},
	'cat_search'
);
