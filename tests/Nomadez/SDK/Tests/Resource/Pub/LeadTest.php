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
     * @group  new
     */
    public function testAnonymousLeadSubmissionToCityLevel()
    {
        $courseClasses = [
            null,
            1,
            2,
        ];

        $response = $this->leadPubRes->create(
            [
                'lead' => [
                    'userCreatedBy' => [
                        'email'   => $this->faker->safeEmail,
                        'profile' => [
                            'firstName' => $this->faker->firstName,
                            'lastName'  => $this->faker->lastName,
                            'phone'     => $this->faker->phoneNumber,
                            'country'   => [
                                'id' => 1,
                            ],
                            'city'      => [
                                'id' => 1,
                            ],
                        ],
                    ],
                    'durationWeeks' => rand(4, 56),
                    'studentNote'   => $this->faker->sentence(),
                    'country'       => [
                        'id' => 1,
                    ],
                    'city'          => [
                        'id' => 1,
                    ],
                    'courseType'    => [
                        'id' => 1,
                    ],
                    'courseClass'   => [
                        'id' => $courseClasses[array_rand($courseClasses)],
                    ],
                    'leadDateStart' => [
                        'id' => rand(1, 4),
                    ],
                ],
            ]
        );

        $payload = $response->getBodyDecoded();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue(ValueHelper::isInteger($payload['id']));
        $this->assertTrue(ValueHelper::isDateTime($payload['created_at']));
    }
}