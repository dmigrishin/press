<?php

namespace CodersTape\Press\Tests;

use Orchestra\Testbench\Testcase;
use CodersTape\Press\MarkdownParser;

class MarkdownTest extends TestCase
{

    /** @test */
    public function simple_markdown_is_parsed()
    {
               
        $this->assertEquals('<h1>Heading</h1>', MarkdownParser::parse('# Heading'));
        //dd(MarkdownParser::parse('# Heading'));

    }
}