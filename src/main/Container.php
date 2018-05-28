<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/18
 */

namespace Lena\src\main;

use ArrayAccess;
use dd\Dump;
use Lena\src\main\Providers\Config;
use Lena\src\main\Providers\Environment;
use Lena\src\main\Providers\Route;
use Psr\Container\ContainerInterface;
use Closure;
use Lena\src\main\Supports\Resolve;


class Container implements ArrayAccess, ContainerInterface
{

    /**
     *
     */
    const PROVIDER_INIT_METHOD = 'initialize';

    /**
     * @var array
     */
    private $defaultProviders = [
        'config' => Config::class,
        'route' => Route::class,
        'env' => Environment::class
    ];

    /**
     * @var Resolve
     */
    protected $resolve;

    /**
     * @var
     */
    public $basePath;

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
     * @param $basePath
     */
    public function __construct($basePath = null)
    {
        $this->resolve = new Resolve($this);
        $this->basePath = $basePath;
        $this->initDefaultProviders();
    }

    /**
     * @param $key
     * @param $bind
     * @param bool $share
     * @return mixed
     */
    public function bind($key, $bind, $share = false)
    {
        $this->binds[$key] = compact("bind", "share");
        return $this->make($key , $bind);
    }

    /**
     * @param $key
     * @param $bind
     * @return mixed
     */
    public function singleton($key, $bind)
    {
        return $this->bind($key, $bind, true);
    }

    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    protected function make($key, $default = null)
    {
        $bind = $this->binds[$key];
        if (isset($this->resolved[$key]) && $bind['share']) {
            return $this->resolved[$key];
        }

        $this->resolved[$key] = $this->resolve->handler($bind['bind']);

        return $this->resolved[$key] ?? $default;
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
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
    public function initDefaultProviders()
    {
        foreach ($this->defaultProviders as $key => $provider) {
            $provider = $this->singleton($key, $provider);
            if (method_exists($provider, self::PROVIDER_INIT_METHOD)) {
                $provider->{self::PROVIDER_INIT_METHOD}();
            }
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

