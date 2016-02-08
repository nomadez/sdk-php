<?php

namespace Nomadez\SDK\Resource\Geo\Country;

use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class Region
 *
 * @package Nomadez\SDK\Resource\Pub
 * @author  Andreas Glaser
 */
class Region extends Resource
{
    /**
     * @param $countryId
     * @param $regionId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function get($countryId, $regionId)
    {
        $request = new Request(sprintf('geo/countries/%d/regions/%d', $countryId, $regionId), 'GET');

        return $this->client->sendRequest($request);
    }

    /**
     * @param $countryId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function getAll($countryId)
    {
        $request = new Request(sprintf('geo/countries/%d/regions', $countryId), 'GET');

        return $this->client->sendRequest($request);
    }
}