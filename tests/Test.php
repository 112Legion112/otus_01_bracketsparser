<?php
/**
 * Created by PhpStorm.
 * User: zapic
 * Date: 05.01.2018
 * Time: 21:37
 */

use PHPUnit\Framework\TestCase;
use Zapic\Brackets\{BracketParser, BracketException};

class Test extends TestCase
{
    protected $parser;

    protected function setUp() {
        $this->parser = new BracketParser();
    }

    public function testRightBrackets() {
        $this->assertTrue($this->parser->parse("()()()"));
        $this->assertTrue($this->parser->parse("()()()((()))"));
        $this->assertTrue($this->parser->parse("((()()))()(())"));
        $this->assertTrue($this->parser->parse("()()()((()))(((((())))))"));
        $this->assertTrue($this->parser->parse("(   )    ( ) ( )"));
    }

    public function testWrongBrackets() {
        $this->assertFalse($this->parser->parse("(((()()())(((())"));
        $this->assertFalse($this->parser->parse("(((("));
        $this->assertFalse($this->parser->parse(")("));
        $this->assertFalse($this->parser->parse("()()())(()()"));
        $this->assertFalse($this->parser->parse("))))"));
        $this->assertFalse($this->parser->parse("((((()())"));
        $this->assertFalse($this->parser->parse("(()()()()))((((()()()))(()()()(((()))))))"));
    }

    public function testThrowsWhenHasPlusSymbol() {
        $this->expectException(InvalidArgumentException::class);
        $this->parser->parse("(+)");
    }

    public function testThrowsWhenHasNumberSymbol() {
        $this->expectException(InvalidArgumentException::class);
        $this->parser->parse("(2)");
    }

    public function testThrowsWhenHasExpressionWithNumbers() {
        $this->expectException(InvalidArgumentException::class);
        $this->parser->parse("(2)+(3+4) + 1");
    }

    public function testThrowsWithNoBrackets() {
        $this->expectException(InvalidArgumentException::class);
        $this->parser->parse("{}");
    }
}
