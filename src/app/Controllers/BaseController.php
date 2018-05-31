<?php

namespace Lena\app\Controllers;

use Lena\main\Container;

/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/24
 */
class BaseController
{

    /**
     * @var Container
     */
    public $app;

    /**
     * BaseController constructor.
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }
}