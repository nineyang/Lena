<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/21
 */

namespace Lena\main\Http\Response;


class Json extends Response
{

    /**
     * @param array $value
     */
    public static function response(array $value)
    {
        echo json_encode($value);
    }
}