<?php

namespace Nomadez\SDK\Resource;

use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class CourseType
 *
 * @package Nomadez\SDK\Resource\Pub
 * @author  Andreas Glaser
 */
class CourseType extends Resource
{

    /**
     * @param $courseTypeId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function get($courseTypeId)
    {
        $request = new Request(sprintf('course-type/%d', $courseTypeId), 'GET');

        return $this->client->sendRequest($request);
    }

    public function getAll()
    {
        $request = new Request('course-type', 'GET');

        return $this->client->sendRequest($request);
    }
}