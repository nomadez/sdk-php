<?php

namespace Nomadez\SDK\Tests\Resource;

use AndreasGlaser\Helpers\ValueHelper;
use Nomadez\SDK\BaseTestCase;
use Nomadez\SDK\Resource as Resource;

/**
 * Class CourseTypeTest
 *
 * @package Nomadez\SDK\Tests\Resource
 * @author  Andreas Glaser
 */
class CourseTypeTest extends BaseTestCase
{
    /**
     * @var Resource\CourseType
     */
    protected $resource;

    public function init()
    {
        $this->resource = new Resource\CourseType($this->client);
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
        $this->assertIsArray($payload);

        foreach ($payload AS $courseTypeArray) {
            $this->assertCourseTypeArray($courseTypeArray);
        }

        return $payload;
    }

    /**
     * @param array $courseTypeArrays
     *
     * @author  Andreas Glaser
     *
     * @depends testGetAll
     */
    public function testGet(array $courseTypeArrays)
    {
        $key = array_rand($courseTypeArrays);
        $courseTypeArray = $courseTypeArrays[$key];

        $response = $this->resource->get($courseTypeArray['id']);
        $payload = $response->getBodyDecoded();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($payload);
        $this->assertCourseTypeArray($payload);
    }

    /**
     * @param $courseTypeArray
     *
     * @author Andreas Glaser
     */
    private function assertCourseTypeArray($courseTypeArray)
    {
        $this->assertArrayHasKey('id', $courseTypeArray);
        $this->assertArrayHasKey('slug', $courseTypeArray);
        $this->assertArrayHasKey('name', $courseTypeArray);
        $this->assertArrayHasKey('description_short', $courseTypeArray);
        $this->assertArrayHasKey('description_long', $courseTypeArray);
        $this->assertArrayHasKey('image', $courseTypeArray);
        $this->assertArrayHasKey('parent', $courseTypeArray);

        $this->assertTrue(ValueHelper::isInteger($courseTypeArray['id']));
        $this->assertNotEmpty($courseTypeArray['slug']);
        $this->assertRegExp('/^[a-z0-9-]+$/', $courseTypeArray['slug']);
        $this->assertNotEmpty($courseTypeArray['name']);
        $this->assertNotEmpty($courseTypeArray['description_short']);
        $this->assertNotEmpty($courseTypeArray['description_long']);
        $this->assertNotEmpty($courseTypeArray['image']);
    }
}