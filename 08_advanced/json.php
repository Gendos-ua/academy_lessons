<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 21:11
 */


header('Content-type: text/plain');

$params=['inner' => ['la', 'la"la'],'secret'=>'4nfflkn42rnk2l3krn2l3fewfw выфвфы алло', 'login'=>'admin', 'password'=>'p1assword'];


$func = 'printf';

$response = json_encode($params, JSON_PRETTY_PRINT);

if (json_last_error() === JSON_ERROR_NONE) {
    $func($response);
} else {
    $func('Error: '.json_last_error_msg());
}

$data = json_decode($response, false);

//var_dump($data);