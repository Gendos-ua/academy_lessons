<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/13/17
 * Time: 18:46
 */

ini_set('display_errors', 1);

function foo(
    int $param1,
    string $param2,
    bool $param3,
    float $param4,
    array $param5
): int
{
    static $staticVar = 0;

    $var1 = 2;

    var_dump(func_get_args());

    return 0;
}




foo(1.2, 'bar', false, 1, []);

$num =  1.2;
$num2 = (integer) $num;
$num2 = (double) $num;
$num2 = (boolean) $num;




function bar()
{
    static $staticVar = 0;

    $staticVar++;

    echo $staticVar.'<br>';
}

$c = 5;
while (--$c) { bar(); }

echo "<hr>";

function count_multi(array $data)
{
    $counter = 0;

    foreach ($data as $item) {
        if (is_array($item)) {
            $counter += count_multi($item);
        } else {
            $counter++;
        }
    }

    return $counter;
}


echo count_multi([
    1, [
        2, [
            3, [
                4,
                5,
                6,
            ]
        ]
    ]
]);


echo "<hr>";

function bar2()
{
    static $data = null;

    if (!$data) {
        echo 'data generated', "<br>";
        $data = rand(1, 100);
    }

    return $data;
}

$c = 4;
while (--$c) { echo bar2(rand(101,300)), "<br>"; }

echo "<hr>";

$sum = function (int $num) {
    $innerFunc = null;

    $innerFunc = function ($inner = null) use ($num, &$innerFunc) {
        static $innerVal = 0;
        if ($inner) {
            $innerVal += $inner+$num;
            return $innerFunc;
        }
        return $innerVal;
    };

    return $innerFunc;
};

//$plusTen = $sum(10);
//echo $plusTen(5)(), "<br>";
//echo $plusTen(10)(), "<br>";

var_dump($sum(30)(15)(100)(100)(300)());


echo "<hr>";

//print_r(explode('.', '.'));


$array = [
    null,
    false,
    0,
    '',
    0.0,
    [null, 0],
];

print_r(array_filter($array, function($value, $key) {

    return $key%2 == 0;


}, ARRAY_FILTER_USE_BOTH));


echo '<hr>';

$toSort = range(1, 5);
shuffle($toSort);
echo print_r($toSort, 1), "<br>";


uasort($toSort, function ($a, $b) {
    if ($a == $b) {
        return 0;
    }

    return ($a < $b) ? -1 : 1;
});

print_r($toSort);



echo '<hr>';

$toSort = array_map('strval', $toSort);

var_dump($toSort);


echo '<hr>';

$data = [];
for($i = 0; $i < 10; $i++)
{
    $inner = range($i*10, $i*20);
    shuffle($inner);
    $data[] = $inner;
}

$data = array_map('array_sum', $data);
print_r($data);
var_dump(max($data));


echo '<hr>';

echo (new MessageFormatter('ru-RU', '{n, spellout}'))
    ->format(['n' => 10235]);

echo '<hr>';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $str1 = $_POST['string1'];
    $str2 = $_POST['string2'];

    print_r(getCommonWords($str1, $str2));
}

function getCommonWords($a, $b)
{

    return [];
}

?>
<form method="post">
    <textarea name="string1"></textarea>
    <textarea name="string2"></textarea>
    <input type="submit" value="send">
</form>
