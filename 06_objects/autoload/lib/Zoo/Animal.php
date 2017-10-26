<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/25/17
 * Time: 19:45
 */

namespace Zoo;


class Animal
{
    protected $name = __CLASS__;

    protected $storage = [];


    public function get()
    {
        $connection = new Inner\Database();
    }

    public function __toString()
    {
        return 'I am '.__CLASS__;
    }

    public function __get($name)
    {
        echo 'Trying to get '.$name;
        return $this->storage[$name];
    }

    public function __set($name, $value)
    {
        echo 'Trying to set '.$name;
        $this->storage[$name] = $value;
    }


    public function __sleep()
    {
        echo 'Going to sleep<br>';

        return ['name'];
    }

    public function __wakeup()
    {
        echo 'Waking up<br>';
    }


    public function __call($name, $arguments)
    {
        echo 'Trying to call '.$name;
    }

    public static function __callStatic($name, $arguments)
    {
        echo 'Trying to call static '.$name;
    }
}