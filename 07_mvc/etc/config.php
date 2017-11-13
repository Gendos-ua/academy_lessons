<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/1/17
 * Time: 21:14
 */

use App\Core\Config;

/**
 * Routing
 */
Config::set('routes', ['default', 'admin']);
Config::set('defaultRoute', 'default');
Config::set('defaultController', 'index');
Config::set('defaultAction', 'index');

/**
 * Lang
 */
Config::set('languages', ['en', 'ru']);
Config::set('defaultLanguage', 'ru');



/**
 * Debug
 */
Config::set('debug', true);


/**
 * Meta
 */
Config::set('siteName', 'Academy MVC');

