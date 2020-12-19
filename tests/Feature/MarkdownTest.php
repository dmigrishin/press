<?php

namespace CodersTape\Press\Tests;

use Orchestra\Testbench\Testcase;
use Parsedown;
use CodersTape\Press\MarkdownParser;

class MarkdownTest extends TestCase
{

    /** @test */
    public function experiment(){
        
        

        dd(MarkdownParser::parse('# Heading'));

        

    }
}