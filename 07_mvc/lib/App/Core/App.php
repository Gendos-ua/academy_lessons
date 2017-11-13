<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 19:06
 */

namespace App\Core;

class App
{
    /** @var Router */
    private static $router;

    /**
     * @return Router
     */
    public static function getRouter(): Router
    {
        return self::$router;
    }

    /**
     * @param $uri
     * @throws \Exception
     */
    public static function run($uri)
    {
        static::$router = new Router($uri);

        $route = static::$router->getRoute();
        $className = static::$router->getController();
        $action = static::$router->getAction();
        $params = static::$router->getParams();

        Localization::setLang(static::$router->getLang());
        Localization::load();

        $controllerName = '\App\Controllers\\'
            .($route !== Config::get('defaultRoute') ? 'Admin\\' : '')
            .$className;

        // @todo Show 404 page
        if (!class_exists($controllerName)) {
            throw new \Exception('Controller '.$controllerName.' not found');
        }

        /** @var \App\Controllers\Base $controller */
        $controller = new $controllerName;

        if (!method_exists($controller, $action)) {
            throw new \Exception('Action '.$action.' not found in '.$controllerName);
        }

        if (!$controller instanceof \App\Controllers\Base) {
            throw new \Exception('Controller must extend Base class');
        }

        $controller->$action();

        $view = new \App\Views\Base(
            $controller->getData(),
            $controller->getTemplate()
        );

        $content = $view->render();

        $layout = new \App\Views\Base(
            ['content' => $content],
            ROOT.DS.'views'.DS.$route.'.php'
        );

        echo $layout->render();
    }





}