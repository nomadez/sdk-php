<?php

namespace Nomadez\SDK\Tests\Resource;

use AndreasGlaser\Helpers\ValueHelper;
use Nomadez\SDK\BaseTestCase;
use Nomadez\SDK\Resource as Resource;

/**
 * Class CurrencyTest
 *
 * @package Nomadez\SDK\Tests\Resource
 * @author  Andreas Glaser
 */
class CurrencyTest extends BaseTestCase
{
    /**
     * @var Resource\Geo\Currency
     */
    protected $resource;

    public function init()
    {
        $this->resource = new Resource\Geo\Currency($this->client);
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

        foreach ($payload AS $currencyArray) {
            $this->assertCurrencyArray($currencyArray);
        }

        return $payload;
    }

    /**
     * @param array $currencyArrays
     *
     * @return array
     *
     * @author  Andreas Glaser
     *
     * @depends testGetAll
     */
    public function testGet(array $currencyArrays)
    {
        $key = array_rand($currencyArrays);
        $currencyArray = $currencyArrays[$key];

        $response = $this->resource->get($currencyArray['id']);
        $payload = $response->getBodyDecoded();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($payload);
        $this->assertCurrencyArray($payload);

        return $payload;
    }

    /**
     * @param $currencyArray
     *
     * @author Andreas Glaser
     */
    private function assertCurrencyArray($currencyArray)
    {
        $this->assertArrayKeyExistsNotEmpty('id', $currencyArray);
        $this->assertArrayKeyExistsNotEmpty('slug', $currencyArray);
        $this->assertArrayKeyExistsNotEmpty('name', $currencyArray);
        $this->assertArrayKeyExistsNotEmpty('iso3', $currencyArray);
        $this->assertArrayKeyExistsNotEmpty('symbol', $currencyArray);

        $this->assertTrue(ValueHelper::isInteger($currencyArray['id']));
        $this->assertRegExp('/^[a-z0-9-]+$/', $currencyArray['slug']);
        $this->assertRegExp('/^[A-Z0-9-]+$/', $currencyArray['iso3']);
    }
}