<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/29/18
 * Time: 17:29
 */

require_once '../vendor/autoload.php';

$loader = new Twig_Loader_Array(array(
    'index' => 'Hello {{ name }}!',
));

$twig = new Twig_Environment($loader);

echo $twig->render('index', array('name' => 'Anonymous'));