<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/5/14
 */

namespace Lena\src\main\Supports;

use Exception;

/**
 * Class Router
 * @package Lena\src\main\Supports
 */
class Router
{

    /**
     * @var array
     */
    public $routes = [];

    /**
     * @var array
     */
    protected $methods = ['get', 'put', 'delete', 'post'];

    /**
     * @var null
     */
    protected $lastUri = null;

    /**
     * @var null
     */
    protected $lastMethod = null;

    /**
     * @param $middleware
     */
    public function middleware($middleware)
    {
        if (is_string($middleware)) {
            $middleware = [$middleware];
        }
        $this->routes[$this->lastMethod][$this->lastUri]['middleware'] = $middleware;
    }

    /**
     * @param $method
     * @param $arguments
     * @return $this
     * @throws Exception
     */
    public function __call($method, $arguments)
    {
        if (!in_array($method, $this->methods)) {
            throw new Exception("this method is not defined");
        }
        list($uri, $path) = $arguments;
        $this->routes[$method][$uri] = ['path' => $path];
        $this->lastUri = $uri;
        $this->lastMethod = $method;

        return $this;
    }
}