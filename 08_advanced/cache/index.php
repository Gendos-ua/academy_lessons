<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/29/18
 * Time: 20:18
 */

$cacheId = md5($_SERVER['REQUEST_URI']);
$cacheDir = __DIR__.'/cache/';
$cacheLifetime = 5;

function holePuhcn($content) {
    return str_replace([
        '{{username}}'
    ], [
        'Guest'
    ], $content);
}


if (file_exists($cacheDir.$cacheId) && (time()-$cacheLifetime) < filemtime($cacheDir.$cacheId)) {
    $cached = file_get_contents($cacheDir.$cacheId);
    echo holePuhcn($cached);
    exit;
}

ob_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <style type="text/css">
        * {padding: 0; margin: 0;}
        header, main, footer {padding: 50px;}
        header { background-color: #5bc0de; height: 100px; }
        main { background-color: #46b8da; height: 300px; }
        footer { background-color: #bce8f1; height: 50px; }
    </style>
    <title>Title</title>
</head>
<body>
<header>
    <a href="/">Company Name</a>
    <p>Hello {{username}}</p>
</header>
<main>

    Content <?=rand(1, 1000);?>
</main>
<footer>
    &copy; Site name
</footer>
</body>
</html>
<?

$content = ob_get_clean();

echo holePuhcn($content);

file_put_contents($cacheDir.$cacheId, $content, LOCK_EX);

