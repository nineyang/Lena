<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/19
 */

namespace Lena\src\main\Providers;


/**
 * Interface ProviderInterface
 * @package Lena\src\main\Providers
 */
interface ProviderInterface
{
    /**
     * 初始化的一些方法
     * @return mixed
     */
    public function initialize();
}