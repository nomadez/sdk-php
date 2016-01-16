<?php

namespace Nomadez\SDK;

use AndreasGlaser\Helpers\ValueHelper;

/**
 * Class Response
 *
 * @package Nomadez\SDK
 * @author  Andreas Glaser
 */
class Response
{
    /**
     * @var integer
     */
    protected $statusCode;
    /**
     * @var string
     */
    protected $bodyRaw;
    /**
     * @var array
     */
    protected $bodyDecoded;

    /**
     * @var boolean
     */
    protected $success = false;

    /**
     * Response constructor.
     *
     * @param $statusCode
     * @param $body
     * @param $headers
     *
     * @author Andreas Glaser
     */
    public function __construct($statusCode, $body, $headers)
    {
        $this->statusCode = $statusCode;
        // guess if request succeeded

        if (ValueHelper::isInteger($this->statusCode) && $this->statusCode >= 200 && $this->statusCode < 300) {
            $this->setIsSuccess(true);
        }

        $this->bodyRaw = $body;
        $this->bodyDecoded = json_decode($body, true);
        $this->headers = $headers;
    }

    /**
     * @param $success
     *
     * @return $this
     * @author Andreas Glaser
     */
    public function setIsSuccess($success)
    {
        $this->success = (bool)$success;

        return $this;
    }

    /**
     * @return bool
     * @author Andreas Glaser
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return integer
     * @author Andreas Glaser
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     * @author Andreas Glaser
     */
    public function getBodyRaw()
    {
        return $this->bodyRaw;
    }

    /**
     * @return array
     * @author Andreas Glaser
     */
    public function getBodyDecoded()
    {
        return $this->bodyDecoded;
    }

    /**
     * @return mixed
     * @author Andreas Glaser
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}