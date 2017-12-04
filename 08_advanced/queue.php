<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/4/17
 * Time: 19:48
 */

$q = new SplQueue();
$q->enqueue('Hello');
$q->enqueue('World');

echo $q->dequeue(), ' ', $q->dequeue();
