<?php

namespace Nomadez\SDK\Tests\Resource\Country;

use AndreasGlaser\Helpers\ArrayHelper;
use Nomadez\SDK\BaseTestCase;
use Nomadez\SDK\Resource as Resource;

/**
 * Class RegionTest
 *
 * @package Nomadez\SDK\Tests\Resource\Country
 * @author  Andreas Glaser
 */
class RegionTest extends BaseTestCase
{
    /**
     * @var Resource\Geo\Country\Region
     */
    protected $resource;

    public function init()
    {
        $this->resource = new Resource\Geo\Country\Region($this->client);
    }

    /**
     * @return array
     * @author Andreas Glaser
     */
    public function testGetAll()
    {
        $response = $this->resource->getAll(85);
        $payload = $response->getBodyDecoded();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($payload);

        foreach ($payload AS $regionArray) {
            $this->assertRegionArray($regionArray);
        }

        return $payload;
    }

    /**
     * @param array $regionArrays
     *
     * @return array
     * @author  Andreas Glaser
     *
     * @depends testGetAll
     */
    public function testGet(array $regionArrays)
    {
        $regionArray = ArrayHelper::getRandomValue($regionArrays);

        $response = $this->resource->get($regionArray['country']['id'], $regionArray['id']);
        $payload = $response->getBodyDecoded();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($payload);
        $this->assertRegionArray($payload);

        return $payload;
    }

    /**
     * @param $regionArray
     *
     * @author Andreas Glaser
     */
    private function assertRegionArray($regionArray)
    {
        $this->assertArrayKeyExistsNotEmpty('id', $regionArray);
        $this->assertArrayKeyExistsNotEmpty('slug', $regionArray);
        $this->assertArrayKeyExistsNotEmpty('name', $regionArray);
        $this->assertArrayKeyExistsNotEmpty('country', $regionArray);
        $this->assertArrayKeyExistsNotEmpty('id', $regionArray['country']);
    }
}