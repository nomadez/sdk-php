<?php

namespace Nomadez\SDK\Resource;

use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class CourseClass
 *
 * @package Nomadez\SDK\Resource\Pub
 * @author  Andreas Glaser
 */
class CourseClass extends Resource
{
    /**
     * @param $courseClassId
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function get($courseClassId)
    {
        $request = new Request(sprintf('course-classes/%d', $courseClassId), 'GET');

        return $this->client->sendRequest($request);
    }

    /**
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function getAll()
    {
        $request = new Request('course-classes', 'GET');

        return $this->client->sendRequest($request);
    }
}