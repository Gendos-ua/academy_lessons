<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 20:25
 */

/** @var array $data */

$router = \App\Core\App::getRouter();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=\App\Core\Config::get('siteName')?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/default.css" >
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/"><?=__('header.homepage')?></a>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=$router->buildUri('pages.index')?>"><?=__('header.pages')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$router->buildUri('contacts.index')?>"><?=__('header.contact_us')?></a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="container main">
        <div class="row">
            <?=$data['content']?>
        </div>
    </main>
</body>
</html>
