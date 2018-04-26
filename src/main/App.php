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
     * App constructor.
     */
    public function __construct()
    {
        if (is_null($this->container)) {
            $this->container = new Container();
        }

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