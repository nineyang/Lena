<?php
/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/16
 */

namespace Lena\main\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use ArrayAccess;

class Request implements RequestInterface, ArrayAccess
{

    /**
     * @var
     */
    protected $headers;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->headers = $_SERVER;
        $this->params = $this->all();
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
        return $value;
    }

    /**
     *
     * @return array
     */
    public function all()
    {
        return array_merge($_REQUEST , $this->params);
    }

    /**
     * @return mixed
     */
    public function getProtocolVersion()
    {
        $protocol = $this->getHeader("SERVER_PROTOCOL");
        list($method, $version) = explode("/", $protocol);
        return $version;
    }

    /**
     * @param string $version
     * @return null
     */
    public function withProtocolVersion($version)
    {
        return $this->getHeader("SERVER_PROTOCOL");
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader($name)
    {
        return isset($this->headers[$name]);
    }

    /**
     * @param string $name
     * @param null $default
     * @return null
     */
    public function getHeader($name, $default = null)
    {
        return $this->hasHeader($name) ? $this->headers[$name] : $default;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
    }

    /**
     * @param string $name
     * @param string|\string[] $value
     * @return mixed
     */
    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
    }

    /**
     * @param string $name
     * @param string|\string[] $value
     * @return mixed
     */
    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        // TODO: Implement getBody() method.
    }

    /**
     * @param StreamInterface $body
     * @return mixed
     */
    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }

    /**
     * @return mixed
     */
    public function getRequestTarget()
    {
        // TODO: Implement getRequestTarget() method.
    }

    /**
     * @param mixed $requestTarget
     * @return mixed
     */
    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->getHeader("REQUEST_METHOD");
    }

    /**
     * @param string $method
     * @return mixed
     */
    public function withMethod($method)
    {
        // TODO: Implement withMethod() method.
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->getHeader("REQUEST_URI");
    }

    /**
     * @param UriInterface $uri
     * @param bool $preserveHost
     * @return mixed
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        // TODO: Implement withUri() method.
    }

    /**
     * @return null|string
     */
    public function getPath()
    {
        return $this->hasHeader("PATH_INFO") ? $this->getHeader("PATH_INFO") : "/";
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->params[$offset]);
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
     * @return mixed
     */
    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->params[$offset]);
            return true;
        }

        return false;
    }
}