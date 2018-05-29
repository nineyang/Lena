<?php

/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/17
 */

namespace Lena\main;

use Lena\main\Http\Request;
use Lena\main\Http\Response\Response;

class App
{

    const BASE_NAMESPACE = 'Lena';

    /**
     * @var Container|null
     */
    protected $container = null;

    /**
     * @var null|string
     */
    protected $basePath = __DIR__ . '/../../';

    /**
     * App constructor.
     * @param null $basePath
     */
    public function __construct($basePath = null)
    {
        $this->initWhoops();
        $this->basePath = $basePath;
        if (is_null($this->container)) {
            $this->container = new Container($basePath);
        }
    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     *
     */
    protected function initWhoops()
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }


    public function start()
    {
        $request = $this->container->bind('request', Request::class);
        $route = $this->container['route'];
        $res = $route->match($request->getMethod(), $request->getPath());

        $this->parseAndInvoke($res, $request);
        ## todo 注入
    }

    protected function parseAndInvoke(array $info, Request $request)
    {
        if (isset($info['middleware'])) {
            $middlewares = $info['middleware'];
            $middlewareSpace = str_replace('/', '\\', self::BASE_NAMESPACE . '/app/Middlewares/');
            foreach ($middlewares as $middleware) {
                $class = $middlewareSpace . $middleware;
                if (class_exists($class)) {
                    $class::handler($request);
                }
            }
        }
    }
}