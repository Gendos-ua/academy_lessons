<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/11/17
 * Time: 18:52
 */

ini_set('display_errors', 1);

echo '<pre>';

__DIR__;
__FILE__;
define('LESSON', '6');

$i = 1;
ob_start();
var_dump($i);

if ($i < 5) {
    function sayHello($name, $count = 2)
    {
        global $i;

        for($j = 0; $j < func_num_args(); $j++) {
            echo 'param number '.$j, '=', print_r(func_get_arg($j), 1), "\n";
        }

        print_r(func_get_args());

        for (; $i < $count; $i++) {
            echo 'Hello '.$name.'!<br>';
            echo 'Lesson number: '.LESSON.'<br>';
        }
        $GLOBALS['newArray'] = [1,2];

        return __FUNCTION__;
    }
} else {
    /**
     * @param string $name
     * @param int $count
     * @return string
     */
    function sayHello($name, $count = 2)
    {
        global $i;

        for (; $i > $count; $i--) {
            echo 'Hi '.$name.'!<br>';
        }

        return __FUNCTION__;
    }
}

$params = ['me', 4, [1,2,3]];
$result = sayHello(...$params);


var_dump(function_exists('inner'));

function array_sum_custom(...$args)
{
    $result = [];
    foreach ($args as $array) {
        foreach ($array as $element) {
            $result[] = $element;
        }
    }
    return $result;
}


$result = array_sum_custom([1,2], [3,4], [5,6]);

print_r($result);



$array2 = [3,4,23,3];

uasort($array2, 'strnatcmp');

print_r($array2);

$funcName = 'sayHello';
$funcName('not me', 4);

ob_get_clean();

function print_recursive($data, $depth = 0)
{
    echo str_repeat("    ", $depth);

    if (is_array($data)) {
        ++$depth;

        str_repeat("    ", $depth);
        echo gettype($data) . ":\n";

        foreach ($data as $key => $element) {
            print_recursive($element, $depth);
        }
    } else {
        echo gettype($data) . " => " . $data."\n";
    }
}

print_recursive(
    [
        1,
        [
            2,
            [
                3,
                [
                    4,
                    [
                        5,
                    ]
                ]
            ]
        ]
    ]
);


$array = [
    0 => [
        'name' => 'Kolya',
        'data' => '3',
    ],
    1 => [
        'name' => 'Anton',
        'data' => '3',
    ]
];

$names = array_column($array, 'name');

print_recursive($names);

$y = 10;

$anonymous1 = function ($x) use (&$y) {
    return function ($z) use ($x) {
        return $z+$x;
    };
};

$y = 5;


function &refFunc(&$x)
{
    $x++;
    return $x;
}

$num = 10;

$num2 = refFunc($num);
$num2++;

print_recursive([$num, $num2]);