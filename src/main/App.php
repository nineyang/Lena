<?php

/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/17
 */

namespace Lena\src\main;

use Lena\src\main\Http\Request;

class App
{
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
        $this->bathPath = $basePath;
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
        $request = $this->container->bind('request' , Request::class);


    }
}