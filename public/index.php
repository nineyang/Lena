<?php
/**
 * Project: lena
 *
 * Author: Nine
 * Date: 2018/4/15
 */
require_once __DIR__ . '/../vendor/autoload.php';

$app = new \Lena\main\App(realpath(__DIR__ . '/../'));
$app->start();