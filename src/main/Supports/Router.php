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
    public $replaces = [];

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
        $this->routes[$this->lastMethod][$this->getLastUri()]['middleware'] = $middleware;
    }

    /**
     * @param $uri
     * @return array
     */
    protected function wrapRouter($uri)
    {
        $res = [];
        $newUri = preg_replace_callback('/{(\w+)}/i', function ($match) use ($uri, &$res) {
            $res[] = $match[1];
            return '(\w+)';
        }, $uri);
        if ($res) {
            $newUri = '/' . str_replace('/', '\/', $newUri) . '/';
        }
        $this->setReplace($uri, $newUri);
        return $res;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setRoute(array $params)
    {
        $this->routes[$this->lastMethod][$this->getLastUri()] = $params;
        return $this;
    }

    /**
     * @param $method
     * @return array|mixed
     */
    public function getRoutes($method)
    {
        return $method ? $this->routes[$method] : $this->routes;
    }

    /**
     * @param $old
     * @param $new
     * @return $this
     */
    public function setReplace($old, $new)
    {
        $this->replaces[$old] = $new;
        return $this;
    }

    /**
     * @param $uri
     * @return bool
     */
    public function existsReplace($uri)
    {
        return isset($this->replaces[$uri]);
    }

    /**
     * @param $uri
     * @return mixed
     */
    public function getReplace($uri)
    {
        return $this->replaces[$uri];
    }

    /**
     * @return mixed|null
     */
    public function getLastUri()
    {
        return $this->existsReplace($this->lastUri) ? $this->getReplace($this->lastUri) : $this->lastUri;
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
        $this->lastUri = $uri;
        $this->lastMethod = $method;
        $params = $this->wrapRouter($uri);
        $this->setRoute(['controller' => $path, 'params' => $params]);

        return $this;
    }
}