<?php
include '../vendor/autoload.php';
include '../libs/Config.php';
include '../libs/Parser/ParserInterface.php';

include '../libs/Parser/Json.php';
include '../libs/Parser/Yaml.php';
include '../libs/Parser/Ini.php';
$conf = new Ashrey\Config\Config();
$var = $conf->read('config.json');
d($var);

$var = $conf->read('config.yml');
d($var);

$var = $conf->read('config.ini');
d($var);