<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/7/17
 */

namespace Lena\main\Providers;

use Monolog\Logger as LoggerProvider;
use Monolog\Handler\StreamHandler;

class Logger extends AbstractProvider
{

    public $log = null;

    /**
     *
     */
    public function initialize()
    {
        $logName = $this->container['env']->get('LOG_NAME', $this->container['env']->get('APP_NAME'));
        $level = strtoupper($this->container['env']->get('LOG_LEVEL', 'WARNING'));
        $log = new LoggerProvider($logName);
        $log->pushHandler(new StreamHandler($this->container->basePath . '/cache/log/' . $logName . '.log',
            constant('Monolog\Logger::' . $level)));
        $this->log = $log;
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        $this->log->{$method}(...$arguments);
    }
}