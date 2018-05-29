<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/19
 */

namespace Lena\main\Providers;

/**
 * Class Config
 * @package Lena\main\Providers
 */
class Config extends ProviderAbstract
{

    /**
     * @var null
     */
    protected $configPath = null;

    /**
     * @var array
     */
    protected $cache = [];

    /**
     * @param $fileName
     * @return mixed
     */
    public function get($fileName)
    {
        if (isset($this->cache[$fileName])) {
            return $this->cache[$fileName];
        }

        # 匹配目录
        if (false !== strpos($fileName, '.')) {
            $fileName = str_replace('.', '/', $fileName);
        }

        $file = $this->configPath . $fileName . '.php';
        if (file_exists($file)) {
            $this->cache[$fileName] = require_once $file;
        }

        return $this->cache[$fileName];
    }

    /**
     *
     */
    public function initialize()
    {
        if (is_null($this->configPath)) {
            $this->configPath = $this->container->basePath . '/config/';
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

}