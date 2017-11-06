<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/1/17
 * Time: 21:01
 */

namespace App\Core;


use App\Core\Config;

class Router
{
    protected $controller;

    protected $action;

    protected $route;

    protected $params;


    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    public function __construct(string $uri)
    {
        $this->controller = Config::get('defaultController');
        $this->action = Config::get('defaultAction');
        $this->route = Config::get('defaultRoute');


        $parts = parse_url($uri);

        $pathParts = explode(
            '/',
            trim($parts['path'], '/')
        );

        if (current($pathParts) && in_array(current($pathParts), Config::get('routes'))) {
            $this->route = array_shift($pathParts);
        }

        if (current($pathParts)) {
            $this->controller = array_shift($pathParts);
        }

        if (current($pathParts)) {
            $this->action = array_shift($pathParts);
        }

        $this->params = $pathParts;

    }
}