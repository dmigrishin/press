<?php

namespace CodersTape\Press;

class MarkdownParser
{

    public static function parse($string)
    {
        $parsedown = new \Parsedown();

        return $parsedown->text($string);
    }


}
