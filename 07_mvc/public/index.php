<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/1/17
 * Time: 20:31
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));


spl_autoload_register(function ($name) {
    $name = str_replace(
        '\\',
        DS,
        $name
    );
    include_once ROOT.DS.'lib'.DS.$name.'.php';
});


include_once ROOT.DS.'conf'.DS.'config.php';

$uri = $_SERVER['REQUEST_URI'];

$router = new \App\Core\Router($uri);

echo '<pre>';
echo 'Route: '.$router->getRoute().PHP_EOL;
echo 'Controller: '.$router->getController().PHP_EOL;
echo 'Action: '.$router->getAction().PHP_EOL;
echo 'Params: '.print_r($router->getParams(), 1).PHP_EOL;