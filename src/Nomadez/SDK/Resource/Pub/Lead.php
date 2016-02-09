<?php

namespace Nomadez\SDK\Resource\Pub;

use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class Lead
 *
 * @package Nomadez\SDK\Resource\Pub
 * @author  Andreas Glaser
 */
class Lead extends Resource
{
    /**
     * @param array $data
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function create(array $data)
    {
        if (!array_key_exists('lead', $data)) {
            $data['lead'] = $data;
        }

        $request = new Request('pub/leads', 'POST', $data);

        return $this->client->sendRequest($request);
    }
}