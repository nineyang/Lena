<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/5/29
 */

namespace Lena\app\Controllers;


use Lena\main\Http\Request;

class Index extends BaseController
{

    public function index(Request $request)
    {
        return view("index", ['name' => $request->get('name')]);
    }

    public function info($name, $age)
    {

    }

    public function user(Request $request, $name)
    {

    }
}