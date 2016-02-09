<?php

namespace Nomadez\SDK\Resource\Geo\Country\Region;

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
     * @param $countryId
     * @param $regionId
     * @param $cityId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function get($countryId, $regionId, $cityId)
    {
        $request = new Request(sprintf('geo/countries/%d/regions/%d/cities/%d', $countryId, $regionId, $cityId), 'GET');

        return $this->client->sendRequest($request);
    }
}