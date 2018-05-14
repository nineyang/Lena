<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/18
 */

return function (\Lena\src\main\Supports\Router $router, $prefix) {
    $router->get('/', 'aaa')->middleware('bbb');
};
