<?php

namespace Lena\app\Controllers;

use Lena\main\App;

/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/24
 */
class BaseController
{

    /**
     * @var App
     */
    public $app;

    /**
     * BaseController constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }
}