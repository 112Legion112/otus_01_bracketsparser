<?php

declare(strict_types=1);

/**
 * Class BracketParser
 *
 * The BracketParser is default implementation of BracketParserInterface
 */

namespace Zapic\Brackets;

class BracketParser implements BracketParserInterface
{
    /**
     * function parse
     * The function parse brackets
     *
     * @param string $line
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function parse(string $line) : bool {
        if(preg_match('/[^()\s]/', $line)) {
            throw new \InvalidArgumentException('Wrong symbol found');
        }

        $counter = 0;
        for($i = 0, $len = strlen($line); $i < $len; ++$i) {
            $char = $line[$i];
            if($char === '(') $counter++;
            if($char === ')') $counter--;
        }

        return $counter === 0;
    }
}