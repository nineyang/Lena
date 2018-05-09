<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/19
 */

namespace Lena\src\main\Providers;

/**
 * Class Environment
 * @package Lena\src\main\Providers
 */
class Environment extends ProviderAbstract
{

    /**
     * @var array
     */
    public $cache = [];

    /**
     *
     */
    public function initialize()
    {
        $file = $this->container->basePath . '/.env';
        if (file_exists($file)) {

            $handler = fopen($file, 'r');
            while (($line = fgets($handler)) !== false) {
                putenv($line);
                list($key, $value) = explode("=", $line);
                $this->cache[$key] = $value;
            }
            fclose($handler);
        }
    }

    /**
     * @param $key
     * @param null $default
     * @return array|false|mixed|null|string
     */
    public function get($key, $default = null)
    {
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        }

        $value = getenv($key);
        return $value ? $value : $default;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }
}