<?php

namespace Nomadez\SDK\Resource\Geo;

use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class Currency
 *
 * @package Nomadez\SDK\Resource\Pub
 * @author  Andreas Glaser
 */
class Currency extends Resource
{

    /**
     * @param $currencyId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function get($currencyId)
    {
        $request = new Request(sprintf('geo/currencies/%d', $currencyId), 'GET');

        return $this->client->sendRequest($request);
    }

    /**
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function getAll()
    {
        $request = new Request('geo/currencies', 'GET');

        return $this->client->sendRequest($request);
    }
}