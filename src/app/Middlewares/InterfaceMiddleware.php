<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/5/29
 */

namespace Lena\app\Middlewares;


use Lena\main\Http\Request;

interface InterfaceMiddleware
{
    public static function handler(Request $request);
}