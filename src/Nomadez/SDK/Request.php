<?php

namespace Nomadez\SDK;

/**
 * Class Request
 *
 * @package Nomadez\SDK
 * @author  Andreas Glaser
 */
class Request
{
    /**
     * @var string
     */
    protected $uri;
    /**
     * @var string
     */
    protected $method;
    /**
     * @var array
     */
    protected $payload = [];
    /**
     * @var array
     */
    protected $headers = [];

    /**
     * Request constructor.
     *
     * @param        $uri
     * @param string $method
     * @param array  $payload
     * @param array  $headers
     *
     * @author Andreas Glaser
     */
    public function __construct($uri, $method = 'POST', array $payload = [], array $headers = [])
    {
        $this->setUri($uri);
        $this->setMethod($method);
        $this->setPayload($payload);

        foreach ($headers AS $name => $content) {
            $this->setHeader($name, $content);
        }
    }

    /**
     * @param $uri
     *
     * @return $this
     * @author Andreas Glaser
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return mixed
     * @author Andreas Glaser
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return string
     * @author Andreas Glaser
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     *
     * @author Andreas Glaser
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return array
     * @author Andreas Glaser
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param array $payload
     *
     * @return $this
     * @author Andreas Glaser
     */
    public function setPayload(array $payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @return array
     * @author Andreas Glaser
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param $name
     * @param $content
     *
     * @return $this
     * @author Andreas Glaser
     *
     */
    public function setHeader($name, $content)
    {
        $this->headers[$name] = $content;

        return $this;
    }

}