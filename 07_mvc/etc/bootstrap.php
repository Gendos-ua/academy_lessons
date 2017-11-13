<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 19:14
 */

spl_autoload_register(function ($name) {
    $name = str_replace(
        '\\',
        DS,
        $name
    );
    $absPath = ROOT.DS.'lib'.DS.$name.'.php';

    if (file_exists($absPath)) {
        include_once $absPath;
    }
});

include_once ROOT.DS.'etc'.DS.'config.php';
include_once ROOT.DS.'etc'.DS.'functions.php';

ini_set('display_errors', App\Core\Config::get('debug') ? 1 : 0);
