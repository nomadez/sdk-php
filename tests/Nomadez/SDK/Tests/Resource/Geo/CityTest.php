<?php

namespace Nomadez\SDK\Tests\Resource;

use AndreasGlaser\Helpers\ArrayHelper;
use AndreasGlaser\Helpers\ValueHelper;
use Nomadez\SDK\BaseTestCase;
use Nomadez\SDK\Resource as Resource;

/**
 * Class CityTest
 *
 * @package Nomadez\SDK\Tests\Resource
 * @author  Andreas Glaser
 */
class CityTest extends BaseTestCase
{
    /**
     * @var Resource\Geo\City
     */
    protected $resource;

    public function init()
    {
        $this->resource = new Resource\Geo\City($this->client);
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

        foreach ($payload AS $cityArray) {
            $this->assertCityArray($cityArray);
        }

        return $payload;
    }

    /**
     * @param array $cityArrays
     *
     * @return array
     *
     * @author  Andreas Glaser
     *
     * @depends testGetAll
     */
    public function testGet(array $cityArrays)
    {
        $cityArray = ArrayHelper::getRandomValue($cityArrays);

        $response = $this->resource->get($cityArray['id']);
        $payload = $response->getBodyDecoded();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($payload);
        $this->assertCityArray($payload);

        return $payload;
    }

    /**
     * @param $cityArray
     *
     * @author Andreas Glaser
     */
    private function assertCityArray($cityArray)
    {
        $this->assertArrayKeyExistsNotEmpty('id', $cityArray);
        $this->assertArrayKeyExistsNotEmpty('slug', $cityArray);
        $this->assertArrayKeyExistsNotEmpty('name', $cityArray);
        $this->assertArrayKeyExistsNotEmpty('coordinate', $cityArray);

        $this->assertTrue(ValueHelper::isInteger($cityArray['id']));
        $this->assertRegExp('/^[a-z0-9-]+$/', $cityArray['slug']);
        $this->assertNotEmpty($cityArray['name']);
        $this->assertNotEmpty($cityArray['coordinate']);
    }
}