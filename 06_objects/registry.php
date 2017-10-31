<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/30/17
 * Time: 20:41
 */

class Registry
{
    static protected $storage = [];

    public static function set($key, $value)
    {
        if (!array_key_exists($key, static::$storage)) {
            static::$storage[$key] = $value;
        } else {
            throw new Exception("$key already exists!");
        }
    }

    public static function get($key)
    {
        return static::$storage[$key];
    }

    public static function unset($key)
    {
        unset(static::$storage[$key]);
    }

    protected function __construct() { }
}


Registry::set('name', 'Vasya');
Registry::set('age', 25);


