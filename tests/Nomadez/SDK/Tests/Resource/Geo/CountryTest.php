<?php

namespace Nomadez\SDK\Tests\Resource;

use AndreasGlaser\Helpers\ValueHelper;
use Nomadez\SDK\BaseTestCase;
use Nomadez\SDK\Resource as Resource;

/**
 * Class CountryTest
 *
 * @package Nomadez\SDK\Tests\Resource
 * @author  Andreas Glaser
 */
class CountryTest extends BaseTestCase
{
    /**
     * @var Resource\Geo\Country
     */
    protected $resource;

    public function init()
    {
        $this->resource = new Resource\Geo\Country($this->client);
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

        foreach ($payload AS $countryArray) {
            $this->assertCountryArray($countryArray);
        }

        return $payload;
    }

    /**
     * @param array $countryArrays
     *
     * @author  Andreas Glaser
     *
     * @depends testGetAll
     */
    public function testGet(array $countryArrays)
    {
        $key = array_rand($countryArrays);
        $countryArray = $countryArrays[$key];

        $response = $this->resource->get($countryArray['id']);
        $payload = $response->getBodyDecoded();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($payload);
        $this->assertCountryArray($payload);
    }

    /**
     * @param $countryArray
     *
     * @author Andreas Glaser
     */
    private function assertCountryArray($countryArray)
    {
        $this->assertArrayHasKey('id', $countryArray);
        $this->assertArrayHasKey('slug', $countryArray);
        $this->assertArrayHasKey('name', $countryArray);
        $this->assertArrayHasKey('iso2', $countryArray);
        $this->assertArrayHasKey('iso3', $countryArray);
        $this->assertArrayHasKey('phone_country_code', $countryArray);
        $this->assertArrayHasKey('currency', $countryArray);
        $this->assertArrayHasKey('coordinate', $countryArray);

        $this->assertTrue(ValueHelper::isInteger($countryArray['id']));
        $this->assertNotEmpty($countryArray['slug']);
        $this->assertRegExp('/^[a-z0-9-]+$/', $countryArray['slug']);
        $this->assertNotEmpty($countryArray['name']);
        $this->assertNotEmpty($countryArray['iso2']);
        $this->assertNotEmpty($countryArray['iso3']);
        $this->assertNotEmpty($countryArray['phone_country_code']);
        $this->assertNotEmpty($countryArray['currency']);
        $this->assertNotEmpty($countryArray['coordinate']);
    }

}