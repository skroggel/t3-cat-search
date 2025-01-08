<?php
declare(strict_types=1);
namespace Madj2k\CatSearch\Utilities;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Request;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class SearchParameterUtility
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Steffen Kroggel <developer@steffenkroggel.de>
 *  @package Madj2k_CatSearch
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class SearchParameterUtility
{

    /**
     * Returns the parameter namespace based on the current request
     *
     * @param \TYPO3\CMS\Extbase\Mvc\Request $request
     * @return string
     */
    static public function getParameterNamespace(Request $request): string
    {
        return 'tx_'
            . str_replace('_', '', strtolower($request->getControllerExtensionKey()))
            . '_'
            . str_replace('_', '', strtolower($request->getControllerActionName()));
    }


    /**
     * Unserialize search parameters from request
     *
     * @param \TYPO3\CMS\Extbase\Mvc\Request $request
     * @param string $parameterNamespace
     * @param string $hashKey
     * @return array
     * @throws \TYPO3\CMS\Extbase\Security\Exception\InvalidArgumentForHashGenerationException
     * @throws \TYPO3\CMS\Extbase\Security\Exception\InvalidHashException
     */
    static public function unserializeParameters(Request $request, string $parameterNamespace = '', string $hashKey = 'hash'): array
    {
        $queryParams = $request->getQueryParams();
        if (empty($parameterNamespace)) {
            $parameterNamespace = self::getParameterNamespace($request);
        }

        if (
            (isset($queryParams[$parameterNamespace][$hashKey]))
            && ($hmac = $queryParams[$parameterNamespace][$hashKey])
        ) {

            /** @var \TYPO3\CMS\Extbase\Security\Cryptography\HashService $hashService */
            $hashService = GeneralUtility::makeInstance(HashService::class);

            $stripped = $hashService->validateAndStripHmac($hmac);
            return unserialize(base64_decode($stripped));
        }

        return [];
    }


    /**
     * Serialize search parameter from request
     *
     * @param \TYPO3\CMS\Extbase\Mvc\Request $request
     * @param string $parameterNamespace
     * @param string $parameterName
     * @return string
     */
    static public function serializeParameters(Request $request, string $parameterNamespace = '', string $parameterName = 'search'): string
    {
        $queryParams = $request->getQueryParams();

        if (empty($parameterNamespace)) {
            $parameterNamespace = self::getParameterNamespace($request);
        }

        $hmac = '';
        if (
            (isset($queryParams[$parameterNamespace][$parameterName]))
            && ($parameters = $queryParams[$parameterNamespace][$parameterName])
        ) {

            /** @var \TYPO3\CMS\Extbase\Security\Cryptography\HashService $hashService */
            $hashService = GeneralUtility::makeInstance(HashService::class);

            $hmac = $hashService->appendHmac(
                base64_encode(serialize([$parameterName => $parameters]))
            );
        }

        return $hmac;
    }

}
