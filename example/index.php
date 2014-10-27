<table>
<?php
include '../vendor/autoload.php';
include '../libs/Config.php';
include '../libs/Parser/ParserInterface.php';

include '../libs/Parser/Json.php';
include '../libs/Parser/Yaml.php';
include '../libs/Parser/Ini.php';

$max = 100;
$r   = (int)$max*0.05;

$conf = new Ashrey\Config\Config('./cache', TRUE);
$time = array();
for($i=0;$i<$max;$i++){
    $to = microtime(TRUE);
    $var = $conf->read('config.json', TRUE);
    $var = $conf->read('config.yml', TRUE);
    $var = $conf->read('config.ini', TRUE);
    $tf = microtime(TRUE);
    $time[] = ($tf-$to);
}
sort($time);
for($i=0;$i<$r;$i++)
    array_pop($time);
for($i=0;$i<$r;$i++)
    array_shift($time);
$avr = array_sum($time) / count($time); 
echo "<tr><td>Using cache (no update):</td> <td>$avr</td></tr>";


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
sort($time);
for($i=0;$i<$r;$i++)
    array_pop($time);
for($i=0;$i<$r;$i++)
    array_shift($time);
$avr = array_sum($time) / count($time); 
echo "<tr><td>Using cache:</td> <td>$avr</td></tr>";


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
sort($time);
for($i=0;$i<$r;$i++)
    array_pop($time);
for($i=0;$i<$r;$i++)
    array_shift($time);
$avr = array_sum($time) / count($time); 
echo "<tr><td>Without Cache:</td> <td>$avr</td></tr>";
?>
</table>