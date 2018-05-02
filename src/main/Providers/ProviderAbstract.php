<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/5/2
 */

namespace Lena\src\main\Providers;


use Lena\src\main\Container;

/**
 * Class ProviderAbstract
 * @package Lena\src\main\Providers
 */
abstract class ProviderAbstract implements ProviderInterface
{
    /**
     * @var Container
     */
    public $container;

    /**
     * ProviderAbstract constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}