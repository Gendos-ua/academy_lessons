<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/23/17
 * Time: 17:36
 */

/**
 * L - принцип подстановки Барбары Лисков
 * Liskov Substitution Principle, LSP
 *
 * Сложно:
 * Пусть q(x) является свойством, верным относительно объектов x некоторого типа T.
 * Тогда q(y) также должно быть верным для объектов y типа S, где S является подтипом типа T.
 *
 * Просто:
 * Функции, которые используют базовый тип,
 * должны иметь возможность использовать подтипы базового типа, не зная об этом.
 *
 * Поведение наследуемых классов не должно противоречить поведению базового класса.
 */


$bird = new Duck();
$bird = new Penguin();

function (ICanFly $bird)
{
    $hours = 2;
    echo "За 2 часа я пролечу ".($hours*$bird->fly());
}



interface ICanFly
{
    public function fly();
}

interface ICanSwim
{
    public function swim();
}



/**
 * Class Penguin
 *
 * Не нарушает принцип LSP
 */
class Duck implements ICanFly, ICanSwim
{
    protected $flySpeed = 10;
    protected $swimSpeed = 3;

    public function fly()
    {
        return $this->flySpeed;
    }

    public function swim()
    {
        return $this->swimSpeed;
    }
}


/**
 * Class Penguin
 *
 * Нарушает принцип LSP
 */
class Penguin implements ICanSwim
{
    protected $swimSpeed = 3;

    public function fly()
    {
        return 'Я не могу летать (('; // нетипичное поведение
    }

    public function swim()
    {
        return $this->swimSpeed;
    }
}