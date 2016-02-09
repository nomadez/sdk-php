<?php

namespace Nomadez\SDK\Tests\Resource\Country;

use AndreasGlaser\Helpers\ValueHelper;
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
    public function testGet()
    {
        $response = $this->resource->get(85, 52);
        $payload = $response->getBodyDecoded();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($payload);
        $this->assertRegionArray($payload);

        return $payload;
    }

    /**
     * @return array
     * @author Andreas Glaser
     */
    public function testGetCities()
    {
        $response = $this->resource->getCities(85, 52); // todo: make this dynamic
        $payload = $response->getBodyDecoded();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($payload);

        foreach ($payload AS $cityArray) {
            $this->assertCityArray($cityArray);
        }

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