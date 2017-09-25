<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/20/17
 * Time: 20:54
 */

header('HTTP/1.1 201');
header('Content-Type: application/pdf');
header('X-Content-Type-Options: nosniff');

$fileName = $_GET['name'];
$fileDir = __DIR__.DIRECTORY_SEPARATOR.'gallery_files';

readfile(
    $fileDir
    .DIRECTORY_SEPARATOR
    .$fileName
);