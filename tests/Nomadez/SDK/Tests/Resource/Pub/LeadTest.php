<?php

namespace Nomadez\SDK\Tests\Resource\Pub;

use AndreasGlaser\Helpers\ValueHelper;
use Nomadez\SDK\BaseTestCase;
use Nomadez\SDK\Resource as Resource;

/**
 * Class LeadTest
 *
 * @package Nomadez\SDK\Tests\Resource\Pub
 * @author  Andreas Glaser
 */
class LeadTest extends BaseTestCase
{
    /**
     * @author Andreas Glaser
     */
    public function testAnonymousLeadSubmission()
    {
        $leadPubRes = new Resource\Pub\Lead($this->client);

        $response = $leadPubRes->createAnonymous(
            $this->faker->safeEmail,
            $this->faker->firstName,
            $this->faker->lastName,
            [
                'durationWeeks' => rand(4, 56),
                'studentNote'   => $this->faker->sentence(),
            ]
        );
        $payload = $response->getBodyDecoded();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue(ValueHelper::isInteger($payload['id']));
        $this->assertTrue(ValueHelper::isDateTime($payload['created_at']));
    }
}