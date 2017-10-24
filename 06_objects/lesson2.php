<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/23/17
 * Time: 18:10
 */

ini_set('display_errors', 1);

define('SOME_CONST', 1);
const SOME_OTHER_CONST = 1;

class Human
{
    const VERSION = '0.0.1';

    protected $name;

    public static $staticVar = 10;

    public function getName()
    {
        echo 'staticVar: '.static::$staticVar
            .', class: '.get_called_class()
            .', version: '.static::getVersion();
    }

    public static function getInstance($name)
    {
        return new static($name);
    }

    public static function getVersion()
    {
        return static::VERSION;
    }

    public function __construct($name)
    {
        $this->name = $name;
    }
}

class Male extends Human
{
    const VERSION = '0.0.2';

    public static $staticVar = 20;


    public static function getVersion()
    {
        return parent::getVersion().' From child';
    }

    public function __construct($name)
    {
        parent::__construct($name);
    }
}


$me = Human::getInstance('Vasya');
$male = Male::getInstance('John');

echo get_class($me), '<br>';
echo get_class($male), '<br>';
echo $me->getVersion(), '<br>';


Human::getInstance('Lilie')
    ->getName();
echo '<br>';
Male::getInstance('Kirill')
    ->getName();


//$funcName = 'time';
//echo time().'   ===   '.$funcName();

/*

echo Human::VERSION, PHP_EOL;
Human::$staticVar = 10;



 *
echo PHP_EOL;
$male->getName();
var_dump($me instanceof Human);
var_dump($me instanceof Male);
var_dump($male instanceof Human);
var_dump($male instanceof Male);
var_dump(get_class($male));
*/
