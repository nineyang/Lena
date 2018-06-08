<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/18
 */

return function (\Lena\main\Supports\Router $router, $prefix) {
    $router->prefix($prefix);


    $router->get('/', 'Index@index')->middleware(['Demo']);
    $router->get('/{name}', 'Index@user')->middleware('Demo');
    $router->get('/{name}/{age}', 'Index@info');


};
