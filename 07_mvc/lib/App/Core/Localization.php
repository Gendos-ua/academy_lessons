<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 20:46
 */

namespace App\Core;

class Localization
{
    /** @var array */
    private static $messages;

    /** @var string */
    private static $lang;

    /**
     * @return mixed
     */
    public static function getLang()
    {
        return self::$lang;
    }

    /**
     * @param mixed $lang
     */
    public static function setLang($lang)
    {
        if (in_array($lang, Config::get('languages'))) {
            self::$lang = $lang;
        } elseif (empty(self::$lang)) {
            self::$lang = Config::get('defaultLanguage');
        }
    }

    public static function load()
    {
        $langFile = ROOT.DS.'lang'.DS.static::$lang.'.php';;

        if (!file_exists($langFile)) {
            throw new \Exception('Lang file not found: '.$langFile);
        }

        static::$messages = require $langFile;
    }

    public static function get($code, $default = '')
    {
        $parts = explode('.', $code);

        return isset(static::$messages[$parts[0]][$parts[1]])
            ? static::$messages[$parts[0]][$parts[1]]
            : $default;
    }
}