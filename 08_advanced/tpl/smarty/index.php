<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/29/18
 * Time: 16:47
 */


require_once '../vendor/autoload.php';

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__.'/templates');
$smarty->setCompileDir(__DIR__.'/compile');
$smarty->setCacheDir(__DIR__.'/cache');
$smarty->compile_check = true;

$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
$smarty->assign('name', 'Anonymous');
$smarty->assign('copy', date('Y').' Company');
$smarty->assign([
    'name2' => 'Vasya',
    'age' => 18,
]);
$start = microtime(true);

function insert_getUncachedArea($data)
{
    echo 'Data: '.rand(1, 1010);
}

$smarty->setCacheLifetime(3600);

if (!$smarty->isCached('index.tpl')) {
    // get some data
    $smarty->assign($data);
}

$smarty->display('index.tpl');

echo 'finished = '. (microtime(true) - $start);
