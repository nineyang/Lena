<?php

/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/17
 */

namespace Lena\src\main;

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
        $this->bathPath = $basePath;
        if (is_null($this->container)) {
            $this->container = new Container($basePath);
        }
        var_dump($this->container['env']->get('APP_NAME'));
        exit();
    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }


    public function start()
    {

    }
}