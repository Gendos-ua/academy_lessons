<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/20/17
 * Time: 19:10
 */

namespace App\Core;

class Session
{
    use \App\Core\Traits\Singleton;

    /**
     * Session constructor.
     */
    protected function __construct()
    {
        session_start();
    }

    protected function destroy()
    {
        session_destroy();
        self::$instance = null;
    }

    public function __destruct()
    {
        session_write_close();
    }

    /**
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * @param $key
     */
    public static function unset($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * @param $message
     * @return void
     */
    public static function addFlash($message)
    {
        if (!isset($_SESSION['flash']) || !is_array($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }

        $_SESSION['flash'][] = $message;
    }

    /**
     * @return bool
     */
    public static function hasFlash()
    {
        return !empty($_SESSION['flash']);
    }


    /**
     * @return array
     */
    public static function getFlash()
    {
        $data = isset($_SESSION['flash']) ? $_SESSION['flash'] : [];

        $_SESSION['flash'] = [];

        return $data;
    }


}