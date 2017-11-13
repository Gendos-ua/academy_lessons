<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 20:25
 */

/** @var array $data */

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=\App\Core\Config::get('siteName')?></title>
</head>
<body>
    <header>
        <h3>HEADER</h3>
        <button type="button"><?=__('do_register')?></button>
    </header>
    <main>
        <?=$data['content']?>
    </main>
    <footer>
        <h3>FOOTER</h3>
    </footer>
</body>
</html>
