<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/18/17
 * Time: 18:52
 */

//ini_set('display_errors', 1);

$filename = __DIR__.'/data.txt';
$censoredFilename = __DIR__.'/censored.txt';

// Массив содержит все комментарии
$comments = unserialize(file_get_contents($filename));

// Слова которые мы должны фильтровать
$censored = explode(
    PHP_EOL,
    file_get_contents($censoredFilename)
);


// Строка с сообщением об ошибка
$errors = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Логика оработки запроса
    $author = htmlspecialchars($_POST['author']);
    $comment = htmlspecialchars($_POST['comment']);

    if (strlen($author) && strlen($comment)) {

        $comments[] = [
            'date' => date('H:i:s d.m.Y'),
            'timestamp' => time(),
            'author' => $author,
            'comment' => $comment,
        ];

        file_put_contents($filename, serialize($comments));
    } else {
        $errors[] = "Форма заполнена некорректно";
    }
}


usort($comments, function ($a, $b) {
   return (isset($a['timestamp']) && $a['timestamp'] > $b['timestamp']) ? -1 : 1;
});


// Постраничная навигация
$commentsPerPage = 5;
$currentPage = 1;

if (isset($_GET['p']) && $_GET['p'] > 1) {
    $currentPage = (int) $_GET['p'];
}



// Вырезать нужные комментарии из $comments





?>
<DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <title>Comments</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Поделитесь вашим мнением</h2>

            <?if (!empty($errors)):?>
                <div class="alert alert-danger">
                    <?=implode('<br>', $errors)?>
                </div>
            <?endif;?>
            <form method="post">
                <div class="form-group">
                    <label for="author">Ваше имя:</label>
                    <input type="text" class="form-control"
                           name="author" id="author" required
                            placeholder="Имя пишите здесь">
                </div>

                <div class="form-group">
                    <label for="comment">Ваше мнение:</label>
                    <textarea name="comment" class="form-control"
                              id="comment" ></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Отправить
                </button>
            </form>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <?php

            // Вывод комметариев
            foreach ($comments as $comment):

                // Убираем нежелательные слова из полей
                foreach (['author', 'comment'] as $key):
                    $comment[$key] = str_ireplace(
                        $censored,
                        '[censored]',
                        $comment[$key]
                    );
                endforeach;

                ?>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <?= $comment['author']?>
                        <span><?= $comment['date']?></span>
                    </div>
                    <div class="panel-body">
                        <?= $comment['comment']?>
                    </div>
                </div>
                <hr>
                <?php

            endforeach;

            // Вывод ссылок постраничной навигации
            ?>
            <div class="pagination">
                <a href="?p=1">1</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
