<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/27/17
 * Time: 19:39
 */

session_start();
define('DS', DIRECTORY_SEPARATOR);
ini_set('display_errors', 1);

$config = require 'config'.DS.'global.php';

ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <title>Hello world</title>
</head>
<body>
<?php

$page = 'main';

if (!empty($_GET['page'])) {
    $page = $_GET['page'];
}


// Если человек не авторизован - показываем форму входа
if ($_SESSION['auth']) {
    //$page = 'auth';
}


$parts = [
    'header', $page, 'footer',
];
foreach ($parts as $part) {
    ob_start();

    include 'inc'.DS.$part.'.php';

    $partContent = str_ireplace(
        '{{basket}}',
        "В корзине 3 товара",
        ob_get_clean()
    );

    echo $partContent;
}


?>
</body>
</html>
<?php

$pageContent = ob_get_clean();

echo $pageContent;