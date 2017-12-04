<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/4/17
 * Time: 19:44
 */


$stack = new SplStack();

$stack->push('Hello');
$stack->push('PHP');
$stack->push('Stack');

echo $stack->pop(), ' ', $stack->pop(), ' ', $stack->pop();