<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/27/17
 * Time: 20:06
 */

use App\Core\Config;

class RouterTest extends PHPUnit\Framework\TestCase
{
    public function testInitialization()
    {
        $router = new \App\Core\Router('/user/auth/1');

        $this->assertEquals(Config::get('defaultRoute'), $router->getRoute());
        $this->assertEquals(Config::get('defaultLanguage'), $router->getLang());
        $this->assertEquals('UserController', $router->getController());
        $this->assertEquals('authAction', $router->getAction());
        $this->assertEquals(['1'], $router->getParams());
    }
}