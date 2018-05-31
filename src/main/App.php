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
use Lena\main\Supports\Util;

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
//        $this->initWhoops();
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
        if (is_null($res)) {
            # todo 404
        }

        $this->parseAndInvoke($res, $request);
        ## todo 注入
    }

    protected function parseAndInvoke(array $info, Request $request)
    {
        if (isset($info['middleware'])) {
            $middlewares = $info['middleware'];
            foreach ($middlewares as $middleware) {
                if ($class = Util::checkClassExists($middleware, 'middlewares')) {
                    $class::handler($request);
                }
            }
        }

        list($controller, $action) = explode("@", $info['controller']);
        if ($controllerClass = Util::checkClassExists($controller, 'controllers')) {
            if (method_exists($controllerClass, $action)) {
                $res = $this->container->getResolve()->handler($controllerClass, $action, array_combine($info['params'],
                    $info['matched']));
                var_dump($res);
            }
        }
    }
}