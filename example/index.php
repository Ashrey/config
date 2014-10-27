<?php
include '../vendor/autoload.php';
include '../libs/Config.php';
include '../libs/Parser/ParserInterface.php';

include '../libs/Parser/Json.php';
include '../libs/Parser/Yaml.php';
include '../libs/Parser/Ini.php';

$max = 100;

$conf = new Ashrey\Config\Config('./cache');
$time = array();
for($i=0;$i<$max;$i++){
    $to = microtime(TRUE);
    $var = $conf->read('config.json', TRUE);
    $var = $conf->read('config.yml', TRUE);
    $var = $conf->read('config.ini', TRUE);
    $tf = microtime(TRUE);
    $time[] = ($tf-$to);
}

$avr = array_sum($time) / count($time); 
echo "Using cache: $avr<br />";

$conf = new Ashrey\Config\Config();
$time = array();
for($i=0;$i<$max;$i++){
    $to = microtime(TRUE);
    $var = $conf->read('config.json', TRUE);
    $var = $conf->read('config.yml', TRUE);
    $var = $conf->read('config.ini', TRUE);
    $tf = microtime(TRUE);
    $time[] = ($tf-$to);
}
$avr = array_sum($time) / count($time); 
echo "Without cache: $avr";
