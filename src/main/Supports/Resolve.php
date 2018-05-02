<?php

namespace Lena\src\main\Supports;

use Closure;
use Lena\src\main\Container;
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
     * Resolve constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $value
     * @return mixed|object
     */
    public function handler($value)
    {
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
        return $class->getClass()->newInstance();
    }

    /**
     * @param ReflectionParameter $param
     * @return mixed
     * @throws Exception
     */
    private function resolveOther(ReflectionParameter $param)
    {
        if ($param->isDefaultValueAvailable()) {
            return $param->getDefaultValue();
        }

        throw new Exception("this prams has no default value.");
    }

}