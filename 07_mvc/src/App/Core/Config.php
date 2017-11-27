<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/1/17
 * Time: 20:53
 */

namespace App\Core;

class Config
{
    protected static $storage = [];

    public static function set($param, $value)
    {
        static::$storage[$param] = $value;
    }

    public static function get($param)
    {
        return static::$storage[$param];
    }
}