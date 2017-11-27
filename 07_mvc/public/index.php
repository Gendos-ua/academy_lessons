<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/1/17
 * Time: 20:31
 */


use Monolog\Logger;
use Monolog\Handler\StreamHandler;


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

include_once ROOT.DS.'vendor'.DS.'autoload.php';



try {

    $uri = $_SERVER['REQUEST_URI'];
    App\Core\App::run($uri);

} catch (Exception $e) {

    $log = new Logger('system');
    $log->pushHandler(new StreamHandler('system.log', Logger::WARNING));
    $log->error($e->getMessage());

    if (App\Core\Config::get('debug')) {
        echo '<pre>', var_export($e, 1), '</pre>';
    } else {
        echo 'Something gone wrong...';
    }
}
