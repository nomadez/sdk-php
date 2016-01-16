<?php

namespace Nomadez\SDK;

/**
 * Class Resource
 *
 * @package Nomadez\SDK
 * @author  Andreas Glaser
 */
class Resource
{
    /**
     * @var \Nomadez\SDK\Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    /**
     * @param \Nomadez\SDK\Client $client
     *
     * @return $this
     * @author Andreas Glaser
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}