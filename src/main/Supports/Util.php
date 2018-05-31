<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/5/30
 */

namespace Lena\main\Supports;


class Util
{

    const BASE_NAMESPACE = 'Lena';

    /**
     * @param $class
     * @return mixed
     */
    public static function transformNamespace($class)
    {
        return str_replace('/', '\\', $class);
    }

    /**
     * @param $className
     * @param $space
     * @return bool|mixed
     */
    public static function checkClassExists($className, $space)
    {
        $class = self::transformNamespace(self::BASE_NAMESPACE . '/app/' . ucfirst($space) . '/' . $className);

        return class_exists($class) ? $class : false;
    }

}