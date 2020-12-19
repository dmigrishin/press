<?php

namespace CodersTape\Press\Tests;

use Orchestra\Testbench\TestCase;
use CodersTape\Press\PressFileParser;



class PressFileParserTest extends TestCase{
   
    /** @test */
    public function the_head_and_body_gets_split()
    {
               
        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertStringContainsString('title: hello', $data[1]);
        $this->assertStringContainsString('description: filecontent', $data[1]);
        $this->assertStringContainsString('The content', $data[2]);


    }

    /** @test */
    public function each_head_field_gets_separated(){

        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals('hello', $data['title']);
        $this->assertEquals('filecontent', $data['description']);


    }
}