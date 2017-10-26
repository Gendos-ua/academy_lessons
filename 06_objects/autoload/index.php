<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/25/17
 * Time: 19:43
 */

use Zoo\Animal;
use Zoo\getDogString;
use OtherLib;

ini_set('display_errors', 1);

spl_autoload_register(function ($name) {
    $name = str_replace(
        '\\',
        DIRECTORY_SEPARATOR,
        $name
    );
    var_dump($name);
    include_once 'lib/'.$name.'.php';
});



echo Animal::getSomething();
//$animal = new Animal();


//$dog = new Dog();
//$dog->name = 'Billy';
//echo $dog->name;

/*
$obj = new stdClass();
$obj->name = 1;
echo $obj->name;

$data = (object) [
    'k1' => 'value1', 'k2' => 'value2',
];

var_dump($data);

var_dump($data->{'k1'});




$dog = new Dog();

$dog2 = unserialize(
    serialize($dog)
);

$dog2->getName();

*/