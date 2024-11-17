<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\ViewHelpers\Grouping;

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

use Madj2k\CatSearch\Domain\Model\FilterableInterface;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class FilterablesCategoryViewHelper
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
final class FilterablesByCategoryViewHelper extends AbstractViewHelper
{

	/**
	 * Initialize arguments
	 *
	 * @return void
	 */
	public function initializeArguments(): void
	{
		parent::initializeArguments();
		$this->registerArgument('filterables', ObjectStorage::class, 'The related filterables as array', true);
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

        /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Madj2k\CatSearch\Domain\Model\Filterable> $filterables */
		$filterables = $arguments['filterables'];

        /** @var \Madj2k\CatSearch\Domain\Model\FilterableInterface $filterable */
        $result = [];
        foreach ($filterables as $filterable) {
            if ($filterable instanceof FilterableInterface) {

                $categoryId = $filterable->getCategory()? $filterable->getCategory()->getUid() : 0;
                if (! isset($result[$categoryId])) {
                    $result[$categoryId] = [
                        'category' => $filterable->getCategory() ?? null,
                        'items' => []
                    ];
                }
                $result[$categoryId]['items'][] = $filterable;
            }
        }

        return $result;
	}

}
