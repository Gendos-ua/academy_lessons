<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/4/17
 * Time: 20:39
 */

class ReflectMe
{
    /**
     * ReflectMe constructor.
     *
     * @param $totals
     * @param $date
     */
    public function __construct(int $totals, string $date) {
        echo 'Constructed';
    }

    /**
     * Returns 'hello!'
     *
     * @param $param1
     * @return string
     */
    protected function hello($param1): string
    {
        return 'hello!';
    }

}

$reflection = new ReflectionClass('ReflectMe');
$constructor = $reflection->getConstructor();
//var_dump($constructor->getDocComment());

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<PRE>';

foreach ($reflection->getMethods() as $method) {
    echo PHP_EOL;
    echo ($method->getDocComment()).PHP_EOL;
    echo $method->getName().': '.$method->getReturnType().PHP_EOL;
    $params = $method->getParameters();

    echo 'Params:'.PHP_EOL;

    foreach ($params as $param) {
        $type = '';

        if ($typeObj = $param->getType()) {
            $type = $typeObj;
        }

        echo $param->getName() .': '.$type.PHP_EOL;
    }
}

echo PHP_EOL.PHP_EOL;

/**
 * @param int $count
 * @param string $name
 * @return string
 */
function hello(int $count, string $name)
{
    return str_repeat($name, $count);
}

$reflect = new ReflectionFunction('hello');
echo $reflect->getDocComment();


echo PHP_EOL.PHP_EOL;

$obj = new stdClass();
$obj->prop1 = 'prop1val';
$obj->prop2 = 'prop2val';

$reflect = new ReflectionObject($obj);

foreach ($reflect->getProperties() as $prop) {
    echo $prop->getName().' => '.$prop->getValue($obj).PHP_EOL;
}


exec('');