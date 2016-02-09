<?php

namespace Nomadez\SDK\Tests\Resource\Country\Region;

use AndreasGlaser\Helpers\ValueHelper;
use Nomadez\SDK\BaseTestCase;
use Nomadez\SDK\Resource as Resource;

/**
 * Class CityTest
 *
 * @package Nomadez\SDK\Tests\Resource\Country\Region
 * @author  Andreas Glaser
 */
class CityTest extends BaseTestCase
{
    /**
     * @var Resource\Geo\Country\Region\City
     */
    protected $resource;

    public function init()
    {
        $this->resource = new Resource\Geo\Country\Region\City($this->client);
    }

    /**
     * @return array
     * @author Andreas Glaser
     */
    public function testGet()
    {
        $response = $this->resource->get(85, 52, 1); // todo: make this dynamic
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