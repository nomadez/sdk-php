<?php

namespace Nomadez\SDK\Resource\Geo;

use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class Address
 *
 * @package Nomadez\SDK\Resource\Geo
 * @author  Andreas Glaser
 */
class Address extends Resource
{
    /**
     * @param $addressId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function get($addressId)
    {
        $request = new Request(sprintf('geo/addresses/%d', $addressId), 'GET');

        return $this->client->sendRequest($request);
    }
}