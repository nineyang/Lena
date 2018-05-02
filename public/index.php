<?php
/**
 * Project: lena
 *
 * Author: Nine
 * Date: 2018/4/15
 */

require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($class) {
    $path = '../' . str_replace("\\", "/", $class) . '.php';
    if (file_exists($path)) require_once $path;
});

$app = new \Lena\src\main\App(realpath(__DIR__ . '/../'));
$app->start();