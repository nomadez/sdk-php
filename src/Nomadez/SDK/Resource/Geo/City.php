<?php

namespace Nomadez\SDK\Resource\Geo;

use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class City
 *
 * @package Nomadez\SDK\Resource\Pub
 * @author  Andreas Glaser
 */
class City extends Resource
{

    /**
     * @param $cityId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function get($cityId)
    {
        $request = new Request(sprintf('geo/cities/%d', $cityId), 'GET');

        return $this->client->sendRequest($request);
    }

    /**
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function getAll()
    {
        $request = new Request('geo/cities', 'GET');

        return $this->client->sendRequest($request);
    }
}