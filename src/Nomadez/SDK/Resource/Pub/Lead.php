<?php

namespace Nomadez\SDK\Resource\Pub;

use AndreasGlaser\Helpers\ArrayHelper;
use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class Lead
 *
 * @package Nomadez\SDK\Resource\Pub
 * @author  Andreas Glaser
 */
class Lead extends Resource
{
    /**
     * @param       $email
     * @param       $firstName
     * @param       $lastName
     * @param       $countryId
     * @param array $optionals
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function createAnonymous($email, $firstName, $lastName, $countryId, array $optionals = [])
    {
        $optionalValues = [
            'studentNote'         => null,
            'durationWeeks'       => null,
            'cityId'              => null,
            'schoolId'            => null,
            'schoolCourseId'      => null,
            'courseTypeId'        => null,
            'affiliateId'         => null,
            'affiliateCampaignId' => null,
        ];

        ArrayHelper::assocIndexesExist($optionals, $optionalValues);
        $optionalValues = array_replace_recursive($optionalValues, $optionals);

        $data = [
            'lead' => [
                'userCreatedBy' => [
                    'email'   => $email,
                    'profile' => [
                        'firstName' => $firstName,
                        'lastName'  => $lastName,
                        'country'   => [
                            'id' => $countryId,
                        ],
                    ],
                ],
                'dateStart'     => date('Y-m-d'),
                'durationWeeks' => $optionalValues['durationWeeks'],
                'studentNote'   => $optionalValues['studentNote'],
            ],
        ];

        if ($optionalValues['cityId']) {
            $data['lead']['city']['id'] = $optionalValues['cityId'];
        }

        if ($optionalValues['courseTypeId']) {
            $data['lead']['courseType']['id'] = $optionalValues['courseTypeId'];
        }

        if ($optionalValues['schoolId']) {
            $data['lead']['school']['id'] = $optionalValues['schoolId'];
        }

        if ($optionalValues['schoolCourseId']) {
            $data['lead']['schoolCourse']['id'] = $optionalValues['schoolCourseId'];
        }

        if ($optionalValues['affiliateId']) {
            $data['lead']['affiliate']['id'] = $optionalValues['affiliateId'];
        }

        if ($optionalValues['affiliateCampaignId']) {
            $data['lead']['affiliateCampaign']['id'] = $optionalValues['affiliateCampaignId'];
        }

        $request = new Request('pub/leads', 'POST', $data);

        return $this->client->sendRequest($request);
    }
}