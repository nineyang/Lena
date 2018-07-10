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
use Illuminate\Database\Capsule\Manager as Capsule;

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
        $this->basePath = $basePath;
        if (is_null($this->container)) {
            $this->container = new Container($basePath);
        }
        $this->initWhoops();
        $this->initDB();
    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * 初始化whoops
     */
    protected function initWhoops()
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }

    /**
     * 初始化数据库
     */
    protected function initDB()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => $this->container['env']->get('DB_DRIVER', 'mysql'),
            'host' => $this->container['env']->get('DB_HOST', '127.0.0.1'),
            'database' => $this->container['env']->get('DB_DATABASE'),
            'username' => $this->container['env']->get('DB_NAME'),
            'password' => $this->container['env']->get('DB_PASSWORD'),
            'port' => $this->container['env']->get('DB_PORT'),
            'charset' => $this->container['env']->get('DB_CHARSET', 'utf8'),
            'collation' => $this->container['env']->get('DB_COLLATION', 'utf8_unicode_ci'),
            'prefix' => $this->container['env']->get('DB_PREFIX'),
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }


    /**
     *
     */
    public function start()
    {
        $request = $this->container->singleton('request', Request::class);
        $route = $this->container['route'];
        $res = $route->match($request->getMethod(), $request->getPath());
        if (is_null($res)) {
            # todo 404
        }

        $this->parseAndInvoke($res, $request);
        ## todo 注入
    }

    /**
     * @param array $info
     * @param Request $request
     */
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
                $response = $this->container->getResolve()->handler($controllerClass, $action, array_combine($info['params'],
                    $info['matched'] ?? []));

            }
        }
    }
}