<?php

namespace Nomadez\SDK\Tests\Resource\Pub;

use Nomadez\SDK\BaseTestCase;
use Nomadez\SDK\Resource as Resource;

/**
 * Class UserTest
 *
 * @package Nomadez\SDK\Tests\Resource\Pub
 * @author  Andreas Glaser
 */
class UserTest extends BaseTestCase
{
    /**
     * @author Andreas Glaser
     */
    public function testAuthSchoolOwner()
    {
        $userPubResource = new Resource\Pub\User($this->client);

        $response = $userPubResource->auth(
            $this->config['user.schoolowner']['email'],
            $this->config['user.schoolowner']['password']
        );

        $payload = $response->getBodyDecoded();

        $this->assertTrue($response->isSuccess());
        $this->assertArrayHasKey('id', $payload);
        $this->assertArrayHasKey('api_key', $payload);
    }
}