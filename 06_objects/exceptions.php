<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/23/17
 * Time: 20:21
 */


ini_set('display_errors', 1);


interface IDrivable
{
    const VERSION = '0.1.0';

    public function go($direction);

    public function stop();
}

interface ICargo
{
    public function load();

    public function unload();
}


class Car implements IDrivable, ICargo
{
    public function go($direction)
    {

    }

    public function stop()
    {

    }

    public function load()
    {

    }

    public function unload()
    {

    }
}

class Motobike implements IDrivable
{
    public function go($direction)
    {

    }

    public function stop()
    {

    }
}


class CustomOutOfBoundsException extends Exception implements Throwable
{

}



class Thrower
{
    public function setNum($num)
    {
        if ($num < 10 || $num > 20) {
            throw new CustomOutOfBoundsException(
                'Число должно быть в диапазоне от 10 до 20',
                1
            );
        } elseif ($num < 15) {
            throw new Exception(
                'Число должно быть в диапазоне от 15 до 20',
                2
            );
        } else {

        }
    }
}



IDrivable::VERSION;

echo IDrivable::class;


$obj = new Thrower();


try {
    // пытаемся что-то выполнить
    $obj->setNum(19);
} catch (CustomOutOfBoundsException $e) {
    // что-то пошло не так 1
    // + дополнительная логика
    echo 'Свой класс Ошибка: '.$e->getMessage().':'.$e->getCode();
} catch (Exception $e) {
    // что-то пошло не так
    echo 'Ошибка: '.$e->getMessage().':'.$e->getCode();
}



var_dump($obj);