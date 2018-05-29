<?php

namespace Lena\src\main\Providers;

use Lena\src\main\Supports\Router;
use Exception;

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
     * @var Router
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

    /**
     * @param $method
     * @param $path
     * @return mixed
     */
    public function match($method, $path)
    {
        $routers = $this->getRouters(strtolower($method));
        foreach ($routers as $route => $value) {
            if ($path == $route || $this->pregMatch($route, $path, $value)) {
                return $value;
            }
        }
        ## todo return not matched
    }

    /**
     * @param $route
     * @param $path
     * @return bool
     */
    protected function pregMatch($route, $path, &$result)
    {
        $length = strlen($route);

        if ($length <= 1 || substr($route, $length - 1, 1) != '/') {
            return false;
        }
        if (preg_match_all($route, $path, $matches)) {
            array_shift($matches);
            $result['matched'] = $matches;
            return true;
        }
        return false;
    }

    /**
     * @param null $method
     * @return array
     */
    public function getRouters($method = null)
    {
        return $this->router->getRoutes($method);
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
                    $closure($this->router, $info['filename']);
                }
            }
            closedir($dh);
        }
    }

}