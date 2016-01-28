<?php

namespace Nomadez\SDK\Resource\Pub;

use AndreasGlaser\Helpers\ArrayHelper;
use AndreasGlaser\Helpers\DateHelper;
use Nomadez\SDK\Helpers\ArrayHelperExt;
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
     * @param array $required
     * @param array $optionals
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function createAnonymous(array $required, array $optionals = [])
    {
        $requiredValues = [
            'user' => [
                'email',
                'firstName',
                'lastName',
                'countryId',
            ],
            'lead' => [
                'dateStart',
            ],
        ];

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

        // "validate" input
        ArrayHelperExt::indexesExist($requiredValues, $required);
        ArrayHelper::assocIndexesExist($optionals, $optionalValues);

        $optionalValues = array_replace_recursive($optionalValues, $optionals);

        $data = [
            'lead' => [
                'userCreatedBy' => [
                    'email'   => $required['user']['email'],
                    'profile' => [
                        'firstName' => $required['user']['firstName'],
                        'lastName'  => $required['user']['lastName'],
                        'country'   => [
                            'id' => $required['user']['countryId'],
                        ],
                    ],
                ],
                'dateStart'     => DateHelper::formatOrNull($required['lead']['dateStart'], 'Y-m-d'),
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