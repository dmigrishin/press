<?php

namespace CodersTape\Press;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PressFileParser
{
    protected $filename;

    protected $rawData;
    protected $data;

    public function __construct($filename)
    {
       $this->filename = $filename; 
       $this->splitFile();
       $this->explodeData();
       $this->processFields();
    }

    public function getData(){
        return $this->data;
    }

    protected function splitFile(){
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s',
        File::exists($this->filename) ? File::get($this->filename) : $this->filename,
        $this->data
        );

        //dd($this->data);
    }

    protected function explodeData(){
        //dd(trim($this->data[1]));
        //dd(explode("\n", trim($this->data[1])));
        foreach (explode("\n", trim($this->data[1])) as $fieldString){

            preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);
            $this->data[$fieldArray[1]]=$fieldArray[2];
            
        }
        //dd(trim($this->data[2]));
        $this->data['body'] = trim($this->data[2]);
    }

    protected function processFields(){
        foreach ($this->data as $field => $value){
            // if ($field === 'date') {
            //     $this->data[$field] = Carbon::parse($value);
            //     //dd($value);
            //     //dd($this->data[$field]);
            // } else if ($field === 'body' ){
            //     $this->data[$field] = MarkdownParser::parse($value);
            // }
            
            //if ($field === 'date'){
                $class = 'CodersTape\\Press\\Fields\\'. Str::title($field);
                
                if (class_exists($class) && method_exists($class, 'process')){
                    //dd($class::process($field, $value));
                    $this->data = array_merge(
                        $this->data,
                        $class::process($field, $value)
                    );
                }
            //}

            
            //dd($this->data);
            //dd($field, $value);
            
            //dd($field, $value);
            
        }
        dd($this->data);
    }
}