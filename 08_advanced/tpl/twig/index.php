<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/29/18
 * Time: 16:47
 */

require_once '../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$loader = new Twig_Loader_Filesystem([
    __DIR__.'/templates'
]);;

$twig = new Twig_Environment($loader);
$twig->setCache(__DIR__.'/cache');
$twig->enableAutoReload();

$start = microtime(true);

echo $twig->render(
    'homepage.twig',
    array(
        'username' => 'Anonymous',
        'age' => 20,
    )
);

echo 'finished = '. (microtime(true) - $start);