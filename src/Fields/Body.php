<?php

namespace CodersTape\Press\Fields;

use CodersTape\Press\MarkdownParser;

class Body {
    
    public static function process($type, $value){

        return [
            $type => Markdownparser::parse($value),
        ];

    }

}