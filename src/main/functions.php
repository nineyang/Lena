<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/5/14
 */


if (!function_exists("app")) {
    function app($value)
    {

    }
}


if (!function_exists("dd")) {
    function dd($value)
    {
        \dd\Dump::dump($value);
        exit();
    }
}

if (!function_exists("view")) {
    function view($template, ...$values)
    {

    }
}

if (!function_exists("json")) {
    function json(array $value)
    {

    }
}
