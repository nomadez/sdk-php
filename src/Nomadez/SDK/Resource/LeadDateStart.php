<?php

namespace Nomadez\SDK\Resource;

use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class LeadDateStart
 *
 * @package Nomadez\SDK\Resource
 * @author  Andreas Glaser
 */
class LeadDateStart extends Resource
{

    /**
     * @param $leadDateStartId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function get($leadDateStartId)
    {
        $request = new Request(sprintf('lead-date-starts/%d', $leadDateStartId), 'GET');

        return $this->client->sendRequest($request);
    }

    /**
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function getAll()
    {
        $request = new Request('lead-date-starts', 'GET');

        return $this->client->sendRequest($request);
    }
}