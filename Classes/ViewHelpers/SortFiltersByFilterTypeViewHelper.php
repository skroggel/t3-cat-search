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

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class SortFiltersByFilterTypeViewHelper
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
final class SortFiltersByFilterTypeViewHelper extends AbstractViewHelper
{

	/**
	 * Initialize arguments
	 *
	 * @return void
	 */
	public function initializeArguments(): void
	{
		parent::initializeArguments();
		$this->registerArgument('filters', 'array', 'The filters as array', true);
	}


	/**
	 * @param array $arguments
	 * @param \Closure $renderChildrenClosure
	 * @param \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
	 * @return array
	 */
	public static function renderStatic(
		array $arguments,
		\Closure $renderChildrenClosure,
		RenderingContextInterface $renderingContext
	): array {

		/** @var array $filters */
		$filters = $arguments['filters'];

        /** @var \Madj2k\CatSearch\Domain\Model\Filter $filter */
        $result = [];
        foreach ($filters as $filter) {

            if ($filterType = $filter->getType()) {

                if (! isset($result[$filterType->getUid()])) {
                    $result[$filterType->getUid()] = [
                        'filterType' => $filterType,
                        'filters' => []
                    ];
                }
                $result[$filterType->getUid()]['filters'][] = $filter;
            }

        }

        return $result;
	}

}
