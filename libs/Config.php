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
        'php'  => '\Ashrey\Config\Parser\Php',
    );

    /**
     * Cache path, if empty it not use cache
     * @var string
     */
    protected $cache = '';

    /**
     * Check if update cache
     * @var bool
     */
    protected $no_update = false;

    /**
     *  Construct
     * @param string $cache use cache?
     */
    public function __construct($cache = '', $no_update = FALSE){
        $this->cache      = $cache;
        $this->no_update = $no_update;
    }

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

        if($this->isCached($file)){
            return include $this->cacheName($file);
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
        if(!empty($this->cache))
            $this->writefile($file);
        return $this->_conf[$file];
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

    /**
     * Write Cache of file
     * @param  string $file path
     * @return
     */
    protected function writefile($file){
        if(!is_writable($this->cache)){
            throw new \RuntimeException("$this->cache no is writable dir");
        }
        $text = "<?php\nreturn ".var_export($this->_conf[$file], TRUE).";\n?>";
        return file_put_contents($this->cacheName($file), $text);
    }

    /**
     * Return the cache name of $file
     * @param  string $file
     * @return string       
     */
    protected function cacheName($file){
        $hash = sha1($file);
        return "$this->cache/$hash.php";
    }

    /**
     * Return if $file is cached
     * @param string $file 
     * @return bool
     */
    protected function isCached($file){
        $cache = $this->cacheName($file);
        return !empty($this->cache) 
            && is_readable($cache) 
            && ($this->no_update || filemtime($file) < filemtime($cache));
    }



}