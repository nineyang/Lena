<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/18
 */

return function (\Lena\main\Supports\Router $router, $prefix) {
    $router->prefix($prefix);


    $router->get('/', 'Index@index')->middleware(['Demo' , 'Test']);
    $router->get('/{name}/{id}', 'aaa')->middleware('Demo');


};
