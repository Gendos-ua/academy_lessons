<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 16:18
 */

header('Content-type: text/plain');

$archive = new ZipArchive();
$destination = __DIR__.DIRECTORY_SEPARATOR.'out';
$source = $destination.DIRECTORY_SEPARATOR.'sample.zip';

echo "Распаковуем архив $source".PHP_EOL;

if (($result = $archive->open($source))) {
    echo 'Достаем файлы из архива...'.PHP_EOL;
    $archive->extractTo($destination);
    $archive->close();
    echo 'Архив успешно распакован'.PHP_EOL;
} else {
    echo "Не удалось создать архив. - ";
    var_dump($result);
}