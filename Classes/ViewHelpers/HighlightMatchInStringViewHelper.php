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

use TYPO3\CMS\Core\Text\TextCropper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class HighlightMatchInStringViewHelper
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
final class HighlightMatchInStringViewHelper extends AbstractViewHelper
{

	/**
	 * @var bool
	 */
	protected $escapeOutput = false;


	/**
	 * Initialize arguments
	 *
	 * @return void
	 */
	public function initializeArguments(): void
	{
		parent::initializeArguments();
		$this->registerArgument('haystack', 'string', 'The string to work with', true);
		$this->registerArgument('needle', 'string', 'The string search for', true);
		$this->registerArgument('append', 'string', 'What to append, if truncation happened', false, '&hellip;');
		$this->registerArgument('maxCharacters', 'int', 'The maximum number of characters to include.', false, 200);
		$this->registerArgument('respectWordBoundaries', 'bool', 'If TRUE and division is in the middle of a word, the remains of that word is removed.', false, true);
	}


	/**
	 * @param array $arguments
	 * @param \Closure $renderChildrenClosure
	 * @param \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
	 * @return string
	 */
	public static function renderStatic(
		array $arguments,
		\Closure $renderChildrenClosure,
		RenderingContextInterface $renderingContext
	): string {

		/** @var string $haystack */
		$haystack = strip_tags(
			str_replace(
				"\n",
				' ',
				str_replace("\r",
					' ',
					$arguments['haystack']
				)
			)
		);

		/** @var string $needle */
		$needle = $arguments['needle'];

		/** @var int $maxCharacters */
		$maxCharacters = $arguments['maxCharacters'];

		/** @var bool $respectWordBoundaries */
		$respectWordBoundaries = (bool)($arguments['respectWordBoundaries']);

		/** @var string $append */
		$append = (string)$arguments['append'];

		$startPosMatch = stripos($haystack, $needle);
		if ($startPosMatch !== false) {

			$endPosMatch = $startPosMatch + strlen($needle);
			$teaserBeforeMatch = substr($haystack, 0, $startPosMatch);
			$teaserAfterMatch = substr($haystack, $endPosMatch, strlen($haystack));

			$teaserBeforeMatchTrimmed = GeneralUtility::makeInstance( TextCropper::class)->crop(
				content: $teaserBeforeMatch,
				numberOfChars: intval(($maxCharacters - strlen($needle))/ 2) * -1,
				replacementForEllipsis: $append,
				cropToSpace: $respectWordBoundaries
			);

			$teaserAfterMatchTrimmed = GeneralUtility::makeInstance( TextCropper::class)->crop(
				content: $teaserAfterMatch,
				numberOfChars: intval(($maxCharacters - strlen($needle))/ 2),
				replacementForEllipsis: $append,
				cropToSpace: $respectWordBoundaries
			);

			return $teaserBeforeMatchTrimmed . '<span class="hit">' . $needle . '</span>' . $teaserAfterMatchTrimmed;
		}

		return GeneralUtility::makeInstance( TextCropper::class)->crop(
			content: $haystack,
			numberOfChars: $maxCharacters,
			replacementForEllipsis: $append,
			cropToSpace: $respectWordBoundaries
		);
	}

}
