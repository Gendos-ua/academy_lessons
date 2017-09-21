<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/20/17
 * Time: 19:37
 */

echo 'Enter something: ';

//STDIN > fopen('php://input', 'w');
$input = fgets(STDIN);

//STDOUT > fopen('php://output', 'w');
fwrite(
    STDOUT,
    'You entered: '.$input.PHP_EOL
);
