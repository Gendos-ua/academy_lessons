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

    protected $lang;

    protected $route;

    protected $params;


    /**
     * @return mixed
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @return mixed
     */
    public function getController($clean = false)
    {
        return $this->controller.(!$clean ? 'Controller' : '');
    }

    /**
     * @return mixed
     */
    public function getAction($clean = false)
    {
        return $this->action.(!$clean ? 'Action' : '');
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
        $this->lang = Config::get('defaultLanguage');

        $parts = parse_url($uri);

        $pathParts = explode(
            '/',
            trim($parts['path'], '/')
        );

        if (current($pathParts) && in_array(current($pathParts), Config::get('languages'))) {
            $this->lang = array_shift($pathParts);
        }

        if (current($pathParts) && in_array(current($pathParts), Config::get('routes'))) {
            $this->route = array_shift($pathParts);
        }

        if (current($pathParts)) {
            $this->controller = ucfirst(array_shift($pathParts));
        }

        if (current($pathParts)) {
            $this->action = array_shift($pathParts);
        }

        $this->params = $pathParts;

    }

    /**
     * Builds uri
     *
     * @param $path - Format - lang.route.controller.action
     * @param $params - params array
     * @return string
     */
    public function buildUri($path, $params = [])
    {
        $parts = array_reverse(explode('.', $path));
        $default = [
            Config::get('defaultAction'),
            $this->getController(true),
            $this->getRoute() !== Config::get('defaultRoute') ? $this->getRoute() : '',
            $this->getLang() !== Config::get('defaultLanguage') ? $this->getLang() : '',
        ];

        $c = 0;
        $result = [];
        while ($c++ < 4) {
            $result[] = count($parts) ? array_shift($parts) : $default[$c-1];
        }

        // prepare params
        $paramsString = count($params) ? '/'.implode('/', $params) : '';

        // remove empty parts
        $result = array_filter($result);

        return '/'.implode('/', array_reverse($result)).$paramsString;
    }


}