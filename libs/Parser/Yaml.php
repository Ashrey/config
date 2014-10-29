<?php
namespace Ashrey\Config\Parser;
/**
 * Configuration reader
 * PHP version 5
 * @package Config
 * @license https://raw.github.com/Ashrey/KBackend/master/LICENSE.txt
 * @author Alberto Berroteran
 */
class Yaml implements ParserInterface{
    public function parse($text, $file){
        return \Spyc::YAMLLoad($text);
    }
}