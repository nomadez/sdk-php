<?php

namespace Nomadez\SDK\Tests\Resource;

use AndreasGlaser\Helpers\ArrayHelper;
use Nomadez\SDK\BaseTestCase;
use Nomadez\SDK\Resource as Resource;

/**
 * Class CourseClassTest
 *
 * @package Nomadez\SDK\Tests\Resource
 * @author  Andreas Glaser
 */
class CourseClassTest extends BaseTestCase
{
    /**
     * @var Resource\CourseClass
     */
    protected $resource;

    public function init()
    {
        $this->resource = new Resource\CourseClass($this->client);
    }

    /**
     * @return array
     * @author Andreas Glaser
     */
    public function testGetAll()
    {
        $response = $this->resource->getAll();
        $payload = $response->getBodyDecoded();

        $this->assertEquals(200, $response->getStatusCode());

        foreach ($payload AS $courseClassArray) {
            $this->assertCourseClassArray($courseClassArray);
        }

        return $payload;
    }

    /**
     * @param array $courseClassArrays
     *
     * @author  Andreas Glaser
     *
     * @depends testGetAll
     */
    public function testGet(array $courseClassArrays)
    {
        $courseClassArray =ArrayHelper::getRandomValue($courseClassArrays);

        $response = $this->resource->get($courseClassArray['id']);
        $payload = $response->getBodyDecoded();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($payload);
        $this->assertCourseClassArray($payload);
    }

    /**
     * @param $courseClassArray
     *
     * @author Andreas Glaser
     */
    private function assertCourseClassArray($courseClassArray)
    {
        $this->assertArrayKeyExistsNotEmpty('id', $courseClassArray);
        $this->assertArrayKeyExistsNotEmpty('slug', $courseClassArray);
        $this->assertArrayKeyExistsNotEmpty('name', $courseClassArray);
        $this->assertArrayKeyExistsNotEmpty('order_weight', $courseClassArray);
    }
}