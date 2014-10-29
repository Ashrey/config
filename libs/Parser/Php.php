<?php
namespace Ashrey\Config\Parser;
/**
 * Configuration reader
 * PHP version 5
 * @package Config
 * @license https://raw.github.com/Ashrey/KBackend/master/LICENSE.txt
 * @author Alberto Berroteran
 */
class Php implements ParserInterface{
    public function parse($text, $file){
        if(!preg_match('/^\s*<\?php\s+return\s+/', $text)){
            throw new \RuntimeException("Invalid php configuration file");
        }
        return require $file;
    }
}