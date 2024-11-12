<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\ViewHelpers\Filter;

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
use Madj2k\CatSearch\Utilities\PageLanguageUtility;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class ObjectStorageByLanguageViewHelper
 *
 * @author Steffen Kroggel <mail@steffenkroggel.de>
 * @copyright Steffen Kroggel <mail@steffenkroggel.de>
 * @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
final class ObjectStorageByLanguageViewHelper extends AbstractViewHelper
{

	/**
	 * Initialize arguments
	 *
	 * @return void
	 */
	public function initializeArguments(): void
	{
		parent::initializeArguments();
		$this->registerArgument('objectStorage', ObjectStorage::class, 'The objectStorage to filter', true);
        $this->registerArgument('languageUid', 'int', 'The language uid for the filtering.', false, 0);
	}


	/**
	 * @param array $arguments
	 * @param \Closure $renderChildrenClosure
	 * @param \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public static function renderStatic(
		array $arguments,
		\Closure $renderChildrenClosure,
		RenderingContextInterface $renderingContext
	): ObjectStorage {

        /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject> $objectStorage */
        $objectStorage = $arguments['objectStorage'];

        $currentLanguageUid = PageLanguageUtility::getCurrentLanguageId();
        $filteredObjectStorage = new ObjectStorage();

        /** @var \TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject $object */
        foreach ($objectStorage as $object) {
            $objectLanguage = $object->_getProperty($object::PROPERTY_LANGUAGE_UID);
            if (
                ($objectLanguage == $currentLanguageUid)
                || ($objectLanguage == -1)
            ){
                $filteredObjectStorage->attach($object);
            };
        }

        return $filteredObjectStorage;
	}

}
