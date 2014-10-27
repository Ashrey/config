<?php
namespace Ashrey\Config;
/**
 * Configuration reader
 * PHP version 5
 * @package Config
 * @license https://raw.github.com/Ashrey/KBackend/master/LICENSE.txt
 * @author Alberto Berroteran
 */
class Config{

    /**
     * Store all configuration
     * @var array
     */
    protected $_conf = array();

    /**
     * Store all parser registed
     * @var array
     */
    protected $_parser = array(
        'json' => '\Ashrey\Config\Parser\Json',
        'yml'  => '\Ashrey\Config\Parser\Yaml',
        'ini'  => '\Ashrey\Config\Parser\Ini',
    );


    /**
     * Read a config file
     *
     * @param string $file file .ini
     * @param boolean $force force read of  .ini file
     * @return array
     */
    public function read($file, $force = FALSE)
    {
        /*is it memory?*/
        $file = realpath($file);
        if (isset($this->_conf[$file]) && !$force){
            return isset($this->_conf[$file]);
        }
        return $this->parser($file);
    }

    /**
     * Parse a file
     * @param  string $file  path of file
     * @return array
     */
    public function parser($file){
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if(!isset($this->_parser[$ext])){
            throw new \RuntimeException("Extension not register");
        }
        $class = $this->_parser[$ext];
        $obj   = new $class();
        $this->_conf[$file] = $obj->parse($this->readfile($file));



    }

    /**
     * Read a file
     * @param  string $file path
     * @return string
     */
    protected function readfile($file){
        if(!is_readable($file)){
            throw new \RuntimeException("$file no is readable  file");
        }
        return file_get_contents($file);
    }



}