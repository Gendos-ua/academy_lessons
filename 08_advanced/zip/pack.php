<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 16:18
 */

header('Content-type: text/plain');
//47013

$archive = new ZipArchive();
$destination = __DIR__.DIRECTORY_SEPARATOR.'out'.DIRECTORY_SEPARATOR.'sample.zip';
$source = __DIR__.DIRECTORY_SEPARATOR.'in';

echo "Создаем архив $destination".PHP_EOL;

if (($result = $archive->open($destination, ZipArchive::CREATE))) {
    //$archive->setCompressionIndex(1,  ZipArchive::CM_DEFAULT);
    $iter = new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS);

    echo 'Добавляем файлы в архив...'.PHP_EOL;
    foreach ($iter as $info) {
        /** @var SplFileInfo $info */
        if (!$info->isFile()) {
            continue;
        }

        $archive->addFile($info->getPathname(), $info->getBasename());

        echo $info->getBasename().PHP_EOL;
    }

    $archive->close();
} else {
    echo "Не удалось создать архив. - ";
    var_dump($result);
}