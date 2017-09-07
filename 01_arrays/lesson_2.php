<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/6/17
 * Time: 19:00
 */
error_reporting(-1);

ini_set('display_errors', 1);

session_start();



if (!$_GET['param']) {
    header('Location: ?param=1');
    exit;
}




echo '<pre>';
$array = [];

$_SESSION['VIEW_COUNTER']++;

print_r($_SESSION);


$jsonData = json_encode($_SESSION);
echo $jsonData.PHP_EOL;

$stringData = serialize($_SESSION);
echo $stringData.PHP_EOL;

$array = unserialize($stringData);
$arrayJson = json_decode($jsonData, true);

/*echo (string)$array;
print_r($arrayJson);*/



$array = range('A', 'D');
foreach ($array as &$letter) {

    if ($letter == 'A') {
        $letter = 'Z';
    }

}


print_r($array);

foreach ($array as &$letter) {

    if ($letter == 'A') {
        $letter = 'Z';
    }
}
unset($letter);



$letter = 'K';

print_r($array);

print_r($letter);



session_write_close();


