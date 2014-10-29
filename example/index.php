<table>
<?php
include '../vendor/autoload.php';

$max = 100;


function execute($conf, $max){
    $time = array();
    for($i=0;$i<$max;$i++){
        $to = microtime(TRUE);
        $var = $conf->read('config.json', TRUE);
        $var = $conf->read('config.yml', TRUE);
        $var = $conf->read('config.ini', TRUE);
        $var = $conf->read('config.php', TRUE);
        $tf = microtime(TRUE);
        $time[] = ($tf-$to);
    }
    sort($time);
    $r   = (int)$max*0.05;
    for($i=0;$i<$r;$i++)
        array_pop($time);
    for($i=0;$i<$r;$i++)
        array_shift($time);
    return array_sum($time) / count($time);
}

$conf = new \Ashrey\Config\Config('./cache', TRUE);
$time = execute($conf, $max);
echo "<tr><td>Using cache (no update):</td> <td>$time</td></tr>";


$conf = new Ashrey\Config\Config('./cache');
$time = execute($conf, $max);
echo "<tr><td>Using cache:</td> <td>$time</td></tr>";


$conf = new Ashrey\Config\Config();
$time = execute($conf, $max);
echo "<tr><td>Without Cache:</td> <td>$time</td></tr>";
?>
</table>