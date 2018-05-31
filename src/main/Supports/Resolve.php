<?php

namespace Lena\main\Supports;

use Closure;
use Lena\main\Container;
use Psr\Container\ContainerInterface;
use ReflectionMethod;
use ReflectionClass;
use ReflectionParameter;
use Exception;

/**
 *
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/28
 */
class Resolve
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $args = [];

    /**
     * Resolve constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $key
     * @return bool
     */
    public function existsArg($key)
    {
        return isset($this->args[$key]);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getArg($key)
    {
        return $this->args[$key];
    }

    /**
     * @param $value
     * @param null $method
     * @param array $args
     * @return mixed|object
     */
    public function handler($value, $method = null, $args = [])
    {
        $this->args = $args;
        if (!is_null($method)) {
            return $this->handlerMethod($value, $method);
        }
        if ($value instanceof Closure) {
            return $this->handlerClosure($value);
        }
        if (class_exists($value)) {
            return $this->handlerClass($value);
        }

        return $value;
    }

    /**
     * @param Closure $closure
     * @return mixed
     */
    protected function handlerClosure(Closure $closure)
    {
        $methodClass = new ReflectionMethod(null, $closure);
        $params = $methodClass->getParameters();
        return $methodClass->invokeArgs(null, $this->resolveDependencies($params));
    }

    /**
     * @param $className
     * @param $method
     * @return mixed
     */
    protected function handlerMethod($className, $method)
    {
        $methodClass = new ReflectionMethod($className, $method);
        $params = $methodClass->getParameters();
        $class = $this->handlerClass($className);
        return $methodClass->invokeArgs($class, $this->resolveDependencies($params));
    }

    /**
     * @param $class
     * @return object
     */
    protected function handlerClass($class)
    {
        $class = new ReflectionClass($class);
        $constructor = $class->getConstructor();
        if (is_null($constructor)) {
            return $class->newInstance();
        }
        $params = $constructor->getParameters();
        return $class->newInstanceArgs($this->resolveDependencies($params));
    }

    /**
     * @param array $params
     * @return array
     */
    private function resolveDependencies(array $params)
    {
        return array_map(function ($param) {
            return $param->getClass() ? $this->resolveClass($param) : $this->resolveOther($param);
        }, $params);
    }

    /**
     * @param ReflectionParameter $class
     * @return object
     */
    private function resolveClass(ReflectionParameter $class)
    {
        if ($class->getClass()->name == get_class($this->container)) {
            return $this->container;
        }
        return $class->getClass()->newInstance();
    }

    /**
     * @param ReflectionParameter $param
     * @return mixed
     * @throws Exception
     */
    private function resolveOther(ReflectionParameter $param)
    {
        if ($this->existsArg($param->name)) {
            return $this->getArg($param->name);
        }

        if ($param->isDefaultValueAvailable()) {
            return $param->getDefaultValue();
        }

        throw new Exception("this prams has no default value.");
    }

}