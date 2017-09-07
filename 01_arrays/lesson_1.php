<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/4/17
 * Time: 18:46
 */

session_start();


error_reporting(-1);
ini_set('display_errors', 1);

echo '<pre>';


$simple = array(
    0 => "First",
    'two' => "Second",
    'three' => "Third",
);

//$simple['three'] = "Fourth";

array_unshift($simple, "Fourth");

//echo $simple['two'];



$second = [
    true => 'one',
    false => 'one',
    1 => 'second',
    '1' => 'second',
    1.5 => 'third',
];

//print_r($second);

$simple = [
    'one' => "1.First",
    'two' => "2.Second",
    'three' => "3.Third",
    'four' => [
        0 => '4.1',
        1 => '4.2',
        3 => '4.3',
    ],
];


//print_r($simple, 1);
//echo $simple['four'][0];


# SORT

$sorted = range('Z', 'A');

shuffle($sorted);

print_r($sorted);

// a - сохранение связи ключ => значение
// u - функция обратного вызова (callback)
// k - сорировка по ключам
// r - обратный порядок сортировки
uasort($sorted, 'strnatcmp');


print_r($sorted);

var_dump(is_callable('strnatcmpdqdqd'));



$r = create_function('$a, $b', '
    return $a > $b;
');

var_dump(is_callable($r));


# Разыменовывание
list(, $a) = range('A', 'Z');
$second = range('A', 'Z')[0];

$alphabet = implode('', range('A', 'Z'));
echo $alphabet[2];



# Функции

$first = range('A', 'C');
$second = range(1, 3);

$first['one'] = $first[1];
$second['one'] = $second[1];

echo 'first=', print_r($first, 1),
     PHP_EOL
     .'second=', print_r($second, 1);

$third = array_merge($first, $second);
echo PHP_EOL.'third=', print_r($third, 1);

$fourth = $first + $second;
echo PHP_EOL.'fourth=', print_r($fourth, 1);

$firstElement = array_shift($first);
echo PHP_EOL.'firstElement=', $firstElement;
echo PHP_EOL.'first=', print_r($first, 1);

echo PHP_EOL.'first count=', count($first);



# Циклы


// Таблица умножения
for ($i = 1; $i <= 10; $i++) {
    for ($a = 1; $a <= 10; $a++) {
        echo str_pad(
            $i * $a,
            4,
            ' ',
            STR_PAD_LEFT
        );
    }
    echo PHP_EOL;
}



$first = range('A', 'Z');

echo 'FOR:'.PHP_EOL;

for (
    $current = reset($first);
    !empty($current);
    $current = next($first)
) {
    $key = key($first);
    echo $key .' => '.$current.PHP_EOL;
}


echo 'FOREACH:'.PHP_EOL;

foreach ($first as $key => $value) {
    echo $key.' => '.$value.PHP_EOL;
}



echo 'FOR (COUNT):'.PHP_EOL;

$first['K='] = $first[10];
unset($first[10]);

$first = array_values($first);
$total = count($first);

for ($i = 0; $i < $total; $i++) {
    $current = $first[$i];

    echo $i .' => '.$current.PHP_EOL;
}

echo PHP_EOL.'last = '
    .$first[count($first)-1];



echo PHP_EOL.'DO WHILE:'.PHP_EOL;

reset($first);
do {
    $current = current($first);
    echo $current.PHP_EOL;
} while (next($first));



echo 'WHILE:'.PHP_EOL;
$i = 10;

while (true) {

    echo $i-- . PHP_EOL;

    if ($i == 8) {
        continue 1;
    }


    switch ($i) {
        case 8:
            echo '8!'.PHP_EOL;
            break;
        case 4:
            echo '4!'.PHP_EOL;
            break 2;
    }
}














