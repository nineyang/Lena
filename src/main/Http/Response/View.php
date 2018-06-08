<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/21
 */

namespace Lena\main\Http\Response;

use Twig_Loader_Filesystem;
use Twig_Environment;

class View extends Response
{


    /**
     * @param $template
     * @param array $params
     * @throws ResponseException
     */
    public static function response($template, $params = [])
    {
        if (false == ($path = getenv("TEMPLATE_PATH"))) {
            throw new ResponseException("you have not define your TEMPLATE_PATH.");
        }
        $path = static::ROOT_PATH . $path;
        if (!is_dir($path)) {
            throw new ResponseException("templates path is not found.");
        }
        $loader = new Twig_Loader_Filesystem($path);
        $options = [];
        if (getenv("TEMPLATE_CACHE") == 'true') {
            $options['cache'] = static::ROOT_PATH . '/cache';
        }
        $twig = new Twig_Environment($loader, $options);

        echo $twig->render($template . '.' . getenv("TEMPLATE_SUFFIX"), $params);
    }
}