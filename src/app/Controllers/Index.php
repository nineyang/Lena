<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/5/29
 */

namespace Lena\app\Controllers;


use Lena\app\Models\User;
use Lena\main\Container;
use Lena\main\Http\Request;

class Index extends BaseController
{

    public function __construct(Container $app, User $user)
    {
        parent::__construct($app);
    }

    public function index(Request $request)
    {
        return json(['nine' => 'aaa']);
    }

    /**
     * @param $name
     * @param $age
     */
    public function info($name, $age, Request $request)
    {
        return view('index', compact('name'));
    }

    public function user(Request $request, $name)
    {

    }
}