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
     * @var Resource\Pub\Lead
     */
    protected $leadPubRes;

    public function init()
    {
        $this->leadPubRes = new Resource\Pub\Lead($this->client);
    }

    /**
     * @author Andreas Glaser
     */
    public function testAnonymousLeadSubmissionToCityLevel()
    {

        $response = $this->leadPubRes->createAnonymous(
            [
                'user' => [
                    'email'     => $this->faker->safeEmail,
                    'firstName' => $this->faker->firstName,
                    'lastName'  => $this->faker->lastName,
                    'countryId' => 1,
                ],
                'lead' => [
                    'dateStart' => $this->faker->dateTimeThisYear->format('Y-m-d'),
                ],
            ],
            [
                'durationWeeks' => rand(4, 56),
                'studentNote'   => $this->faker->sentence(),
                'cityId'        => 1,
                'courseTypeId'  => 1,
            ]
        );

        $payload = $response->getBodyDecoded();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue(ValueHelper::isInteger($payload['id']));
        $this->assertTrue(ValueHelper::isDateTime($payload['created_at']));
    }
}