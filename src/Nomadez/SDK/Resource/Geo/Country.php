<?php

namespace Nomadez\SDK\Resource\Geo;

use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class Country
 *
 * @package Nomadez\SDK\Resource\Pub
 * @author  Andreas Glaser
 */
class Country extends Resource
{
    /**
     * @param $countryId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function get($countryId)
    {
        $request = new Request(sprintf('geo/countries/%d', $countryId), 'GET');

        return $this->client->sendRequest($request);
    }

    /**
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function getAll()
    {
        $request = new Request('geo/countries', 'GET');

        return $this->client->sendRequest($request);
    }

    /**
     * @param $countryId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function getRegions($countryId)
    {
        $request = new Request(sprintf('geo/countries/%d/regions', $countryId), 'GET');

        return $this->client->sendRequest($request);
    }
}