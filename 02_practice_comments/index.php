<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/18/17
 * Time: 18:52
 */

ini_set('display_errors', 1);

$host = 'localhost';
$db   = 'feedback';
$user = 'root';
$pass = 'root';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);



$filename = __DIR__.'/data.txt';
$censoredFilename = __DIR__.'/censored.txt';

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
    $email = htmlspecialchars($_POST['email']);
    $comment = htmlspecialchars($_POST['comment']);

    $numberOfTheDay = 2;

    if (strlen($author) && strlen($comment)) {

        $statement = $pdo->prepare('SELECT id FROM author WHERE email = :email');
        $statement->execute([
            'email' => $email,
        ]);

        $authorId = $statement->fetch(PDO::FETCH_COLUMN);

        try {

            $pdo->beginTransaction();

            if (empty($authorId)) {
                $statement = $pdo->query(
                    "INSERT INTO author (email, author) 
                      VALUES (".$pdo->quote($email).", ".$pdo->quote($author).")"
                );
                $authorId = $pdo->lastInsertId();
            }
            $statement = $pdo->prepare('INSERT INTO comment (author_id1, comment) VALUES (?, ?)');
            $statement->bindValue(1, $authorId);
            $statement->bindParam(2, $willBeComment);
            $willBeComment = $comment;

            $statement->execute();

            $willBeComment = $comment. ' - CLONED\' SELECT * FROM';

            $statement->execute();

            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            $errors[] = $e->getMessage();
        }


    } else {
        $errors[] = "Форма заполнена некорректно";
    }
}


class Comment
{
    private $id;

    private $author;
    private $author_id;
    private $comment;
    private $timestamp;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }


}


$comments = $pdo->query(
    'SELECT comment.*, author.author 
      FROM comment LEFT JOIN author on author.id = comment.author_id
      ORDER BY comment.timestamp DESC;', PDO::FETCH_OBJ);

/*
usort($comments, function ($a, $b) {
   return (isset($a['timestamp']) && $a['timestamp'] > $b['timestamp']) ? -1 : 1;
});
*/

// Постраничная навигация
$commentsPerPage = 5;
$currentPage = 1;

if (isset($_GET['p']) && $_GET['p'] > 1) {
    $currentPage = (int) $_GET['p'];
}



// Вырезать нужные комментарии из $comments

/*
$result = $pdo->query('SELECT comment.id, comment.comment FROM comment', PDO::FETCH_KEY_PAIR);

echo '<pre>';

print_r($result->fetchAll());
*/

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
                    <label for="author">Ваш email:</label>
                    <input type="email" class="form-control"
                           name="email" id="email" required
                           placeholder="Email пишите здесь">
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
            while ($comment = $comments->fetchObject(Comment::class)):
                /* @var Comment $comment */



                ?>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <?= $comment->getAuthor() ?>
                        <span><?= $comment->getTimestamp() ?></span>
                    </div>
                    <div class="panel-body">
                        <?= str_ireplace(
                            $censored,
                            '[censored]',
                            $comment->getComment()
                        ); ?>
                    </div>
                </div>
                <hr>
                <?php

            endwhile;

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
