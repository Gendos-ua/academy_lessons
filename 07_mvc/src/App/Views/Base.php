<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 20:01
 */

namespace App\Views;

use App\Core\App;

class Base
{
    /** @var string */
    protected $template;

    /** @var array */
    protected $data;


    /**
     * @return string
     */
    protected static function getDefaultTemplate()
    {
        $router = App::getRouter();
        $route = $router->getRoute();
        $controller = $router->getController(true);
        $action = $router->getAction(true);

        return ROOT
            .DS.'views'
            .DS.strtolower($route)
            .DS.strtolower($controller)
            .DS.strtolower($action).'.php';
    }


    /**
     * Base constructor.
     * @param array $data
     * @param null $template
     * @throws \Exception
     */
    public function __construct($data = [], $template = null)
    {
        if (!$template) {
            $template = static::getDefaultTemplate();
        }

        if (!file_exists($template)) {
            throw new \Exception('Template not found: ' . $template);
        }

        $this->data = $data;
        $this->template = $template;
    }

    /**
     * @return string
     */
    public function render()
    {
        $data = $this->data;
        ob_start();
        include $this->template;
        return ob_get_clean();
    }
}