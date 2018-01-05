<?php

declare(strict_types=1);

/**
 * Interface BracketParserInterface
 *
 * The BracketParserInterface interface provides the API for checking brackets
 */

namespace Zapic\Brackets;

interface BracketParserInterface
{
    /**
     * Function parse should return true if brackets is right or false otherwise
     *
     * @param string $line
     * @return bool
     */
    function parse(string $line) : bool;
}