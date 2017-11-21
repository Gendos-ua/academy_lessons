<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/20/17
 * Time: 19:11
 */

namespace App\Core\Traits;

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