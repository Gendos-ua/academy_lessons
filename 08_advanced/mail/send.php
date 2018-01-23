<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/22/18
 * Time: 20:12
 */
 
$r = mail(
    'me@localhost',
    'Hello!',
    'Hello there!',
    'From: me@google.com'.PHP_EOL
);

var_dump($r);
