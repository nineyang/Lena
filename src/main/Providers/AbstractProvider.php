<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/5/2
 */

namespace Lena\main\Providers;


use Lena\main\Container;

/**
 * Class ProviderAbstract
 * @package Lena\main\Providers
 */
abstract class AbstractProvider implements InterfaceProvider
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