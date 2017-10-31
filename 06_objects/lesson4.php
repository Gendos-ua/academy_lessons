<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/30/17
 * Time: 19:43
 */

namespace HelloWorld;

ini_set('display_errors', 1);

trait HelloWorld
{


    public static $field = 10;

    public $word = 'world';

    final public function __construct()
    {
        echo __TRAIT__.' constructor, class: '.__CLASS__. '<br>';
        echo 'Hello '.$this->word, '<br>';
    }
}

class HelloWorldUser
{
    use HelloWorld;
}


abstract class Hello
{
    abstract function sayWord();
}

trait Say
{
    private function sayWord()
    {
        echo 'Hello!<br>';
    }
}

trait Say2
{
    use Say;

    public function sayWord()
    {
        echo 'Hello 2!<br>';
    }
}

class HelloWorldClass extends Hello
{
    public $word = 'world';

    use HelloWorld, Say, Say2 {
        Say2::sayWord insteadof Say;
        Say::sayWord as public sayWordAlt;
    }
}

$var = new HelloWorldUser();

$var2 = new HelloWorldClass();
$var2->sayWordAlt();


echo HelloWorld::class;
