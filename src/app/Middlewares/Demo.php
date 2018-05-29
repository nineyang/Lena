<?php

namespace Lena\app\Middlewares;

use Lena\main\Http\Request;

/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/5/29
 */
class Demo extends AbstractMiddleware
{

    /**
     * @param Request $request
     */
    public static function handler(Request $request)
    {
        $request['name'] = "nine";
    }

}