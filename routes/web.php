<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/18
 */

return function (\Lena\src\main\Supports\Router $router, $prefix) {
    $router->prefix($prefix);


    $router->get('/', 'Index@index')->middleware('bbb');
    $router->get('/{name}/{id}', 'aaa')->middleware('aa');


};
