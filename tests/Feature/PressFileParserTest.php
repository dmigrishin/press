<?php

namespace CodersTape\Press\Tests;

use Carbon\Carbon;
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
    public function a_string_can_also_be_used_instead()
    {
               
        $pressFileParser = (new PressFileParser("---\ntitle: hello\n---\nThe content"));

        $data = $pressFileParser->getData();

        $this->assertStringContainsString('title: hello', $data[1]);
        
        $this->assertStringContainsString('The content', $data[2]);


    }

    /** @test */
    public function each_head_field_gets_separated(){

        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals('hello', $data['title']);
        $this->assertEquals('filecontent', $data['description']);


    }

    /** @test */
    public function the_body_gets_saved_and_trimmed(){

        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals("<h1>Heading</h1>\n<p>The content</p>", $data['body']);
        
    }

    /** @test */
    public function a_date_field_gets_parsed()
    {
               
        $pressFileParser = (new PressFileParser("---\ndate: May 14, 1988\n---\n"));

        $data = $pressFileParser->getData();

        $this->assertInstanceOf(Carbon::class, $data['date']);
        $this->assertEquals('05/14/1988', $data['date']->format('m/d/Y'));
        


    }
    
}