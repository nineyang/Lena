<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/5/29
 */

namespace Lena\app\Middlewares;


abstract class AbstractMiddleware implements InterfaceMiddleware
{


    public static function __callStatic($name, $arguments)
    {

    }

}