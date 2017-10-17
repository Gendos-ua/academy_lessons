<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/16/17
 * Time: 19:42
 */

include_once('lib/core.php');

$incPath = $_SERVER['DOCUMENT_ROOT'].'/05_practice_store/inc/admin';
$page = 'main';

if ($_GET['page']) {
    $page = str_replace('/', '', $_GET['page']);
}


ob_start();

include($incPath.'/header.php');

if (!include($incPath."/$page.php")) {
    echo '404';
}

include($incPath.'/footer.php');


echo ob_get_clean();
