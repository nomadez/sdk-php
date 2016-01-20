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
    public function testAnonymousLeadSubmissionToCityLevel()
    {
        $leadPubRes = new Resource\Pub\Lead($this->client);

        $response = $leadPubRes->createAnonymous(
            $this->faker->safeEmail,
            $this->faker->firstName,
            $this->faker->lastName,
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

    /**
     * @author Andreas Glaser
     */
    public function testAnonymousLeadSubmissionToSchoolLevel()
    {return;
        $leadPubRes = new Resource\Pub\Lead($this->client);

        $response = $leadPubRes->createAnonymous(
            $this->faker->safeEmail,
            $this->faker->firstName,
            $this->faker->lastName,
            [
                'durationWeeks' => rand(4, 56),
                'studentNote'   => $this->faker->sentence(),
                'schoolId'      => 1,
                'courseTypeId'  => 1,
            ]
        );

        $payload = $response->getBodyDecoded();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue(ValueHelper::isInteger($payload['id']));
        $this->assertTrue(ValueHelper::isDateTime($payload['created_at']));
    }
}