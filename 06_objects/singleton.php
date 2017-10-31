<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/30/17
 * Time: 20:19
 */


trait Singleton
{
    protected static $instance = null;

    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function __construct() {}

    protected function __clone() {}

    protected function __sleep() {}

    protected function __wakeup() {}
}


class DbConnector
{
    use Singleton;
}

$ob1 = DbConnector::getInstance();
$ob2 = DbConnector::getInstance();



var_dump($ob1 === $ob2);
