<?php

namespace Lena\src\main\Providers;

use Lena\src\main\Supports\Router;

/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/18
 */
class Route extends ProviderAbstract
{
    /**
     * @var null
     */
    protected $routePath = null;

    /**
     * @var null
     */
    protected $router = null;

    /**
     *
     */
    public function initialize()
    {
        $this->routePath = $this->container->basePath . '/routes/';
        $this->router = new Router();
        $this->handler();
    }

    public function match()
    {

    }

    /**
     *
     */
    public function handler()
    {
        if ($dh = opendir($this->routePath)) {
            while (false !== ($file = readdir($dh))) {
                if ($file != '.' && $file != '..') {
                    $info = pathinfo($file);
                    $closure = require_once $this->routePath . $file;
                    $closure($this->router , $info['filename']);
                }
            }
            closedir($dh);
        }
    }

}