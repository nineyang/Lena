<?php

namespace Lena\src\main\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Project: Lena
 *
 * Author: Nine
 * Date: 2018/4/21
 */
abstract class Response implements ResponseInterface
{
    /**
     * @return mixed
     */
    public function getProtocolVersion()
    {
        // TODO: Implement getProtocolVersion() method.
    }

    /**
     * @param string $version
     * @return mixed
     */
    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function hasHeader($name)
    {
        // TODO: Implement hasHeader() method.
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getHeader($name)
    {
        // TODO: Implement getHeader() method.
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
    public function getStatusCode()
    {
        // TODO: Implement getStatusCode() method.
    }

    /**
     * @param int $code
     * @param string $reasonPhrase
     * @return mixed
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        // TODO: Implement withStatus() method.
    }

    /**
     * @return mixed
     */
    public function getReasonPhrase()
    {
        // TODO: Implement getReasonPhrase() method.
    }

}