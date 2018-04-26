<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/18
 */

namespace Lena\src\main;

use ArrayAccess;
use Lena\src\main\Providers\Config;
use Lena\src\main\Providers\Environment;
use Lena\src\main\Providers\Route;
use Psr\Container\ContainerInterface;


class Container implements ArrayAccess, ContainerInterface
{

    private $defaultProviders = [
        'config' => Config::class,
        'route' => Route::class,
        'env' => Environment::class
    ];

    /**
     * first bind array
     * @var array
     */
    protected $binds = [];

    /**
     * has finished init array
     * @var array
     */
    protected $resolved = [];

    /**
     * Container constructor.
     */
    public function __construct()
    {
        $this->initProviders();
    }

    public function bind($key, $bind, $share = false)
    {
        ## todo
        $this->binds[$key] = compact("bind", "share");
    }

    public function singleton($key, $bind)
    {
        $this->bind($key, $bind, true);
    }

    protected function make($key, $default)
    {
        $bind = $this->binds[$key];
        if (isset($this->resolved[$key]) && $bind['share']) {
            return $this->resolved[$key];
        }

        #todo

        return $default;
    }

    public function get($key, $default = null)
    {
        if (!isset($this->binds[$key])) {
            return $default;
        }
        return $this->make($key, $default);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->binds[$key]);
    }

    /**
     *
     */
    public function initProviders()
    {
        foreach ($this->defaultProviders as $key => $provider) {
            $this->bind($key, $provider);
        }
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        return $this->bind($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        if ($this->get($offset)) {
            unset($this->binds[$offset]);
        }
    }
}

