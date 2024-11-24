<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\ViewHelpers;

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

use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class MetaTagViewHelper
 *
 * @author Georg Ringer <mail@ringer.it>
 * @copyright Georg Ringer <mail@ringer.it>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @see \GeorgRinger\News\ViewHelpers\MetaTagViewHelper
 */
class MetaTagViewHelper extends AbstractViewHelper
{

    /**
     * Arguments initialization
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('property', 'string', 'Property of meta tag', false, '', false);
        $this->registerArgument('name', 'string', 'Content of meta tag using the name attribute', false, '', false);
        $this->registerArgument('content', 'string', 'Content of meta tag', true, null, false);
        $this->registerArgument('useCurrentDomain', 'boolean', 'Use current domain', false, false);
        $this->registerArgument('forceAbsoluteUrl', 'boolean', 'Force absolut domain', false, false);
        $this->registerArgument('replace', 'boolean', 'Replace potential existing tag', false, false);
    }

	/**
	 * @param array $arguments
	 * @param \Closure $renderChildrenClosure
	 * @param \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
	 * @return void
	 */
    public static function renderStatic(
		array $arguments,
		\Closure $renderChildrenClosure,
		RenderingContextInterface $renderingContext
	): void {

		/** @var bool $useCurrentDomain */
		$useCurrentDomain = $arguments['useCurrentDomain'];

		/** @var bool $forceAbsoluteUrl */
		$forceAbsoluteUrl = $arguments['forceAbsoluteUrl'];

		/** @var string $content */
		$content = (string) $arguments['content'];

        // set current domain
        if ($useCurrentDomain) {
            $content = GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL');
        }

        // prepend current domain
        if ($forceAbsoluteUrl) {
            $parsedPath = parse_url($content);
            if (is_array($parsedPath) && !isset($parsedPath['host'])) {
                $content =
                    rtrim(GeneralUtility::getIndpEnv('TYPO3_SITE_URL'), '/')
                    . '/'
                    . ltrim($content, '/');
            }
        }

        if ($content !== '') {
            $registry = GeneralUtility::makeInstance(MetaTagManagerRegistry::class);
            if ($arguments['property']) {
                $manager = $registry->getManagerForProperty($arguments['property']);
                $manager->addProperty($arguments['property'], $content, [], $arguments['replace'], 'property');
            } elseif ($arguments['name']) {
                $manager = $registry->getManagerForProperty($arguments['name']);
                $manager->addProperty($arguments['name'], $content, [], $arguments['replace'], 'name');
            }
        }
    }
}
