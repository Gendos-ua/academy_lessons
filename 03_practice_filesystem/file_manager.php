<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/20/17
 * Time: 18:42
 */

define('DS', DIRECTORY_SEPARATOR);

// Определим корневую директорию
$base = $_SERVER['DOCUMENT_ROOT'];

// Определяем путь выбранной директории относительно корня
$path = '';
if (!empty($_GET['dir']) && !in_array($_GET['dir'], ['.', '/'])) {
    $path = $_GET['dir'];
}

// Получаем все файлы и директории из текущего пути
$files = scandir($base.DS.$path);


// Очищаем от лишних элементов
$removeParts = ['.'];
if (!$path) {
    // Если мы в корне - удаляем элемент родительской директории
    $removeParts[] = '..';
}
$files = array_diff($files, $removeParts);



// Формируем данные для вывода
$result = [];
foreach ($files as $file) {
    $name = $file;
    $absFile = $base.DS.$path.DS.$file;

    // Для директорий делаем имя со ссылкой
    if (is_dir($absFile)) {

        if ($file == '..') {
            // Ссылку "вверх" делаем на один элемент вложенности меньше
            $url = dirname($path);
        } else {
            $url = $path.DS.$name;
        }

        $name = "<a href=\"?dir={$url}\">{$name}</a>";
    }

    // Добавляем текущий элемент в массив результата
    $result[] = [
        'name' => $name,
        'size' => round(filesize($absFile)/1024, 2) . ' кб',
        'created_at' => date('H:i:s d.m.Y', filectime($absFile)),
    ];
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <title>File Manager</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover" width="100">
                    <thead>
                        <tr class="bg-warning">
                            <th>Действия</th>
                            <th>Имя файла</th>
                            <th>Размер файла</th>
                            <th>Дата создания</th>
                        </tr>
                    </thead>
                    <tbody>
                    <? foreach ($result as $file): ?>
                        <tr>
                            <td>
                                <?// тут ссылки на действия?>
                            </td>
                            <td><?= $file['name'] ?></td>
                            <td><?= $file['size'] ?></td>
                            <td><?= $file['created_at'] ?></td>
                        </tr>
                    <? endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>