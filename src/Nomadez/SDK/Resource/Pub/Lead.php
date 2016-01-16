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
     * @param array $optionals
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function createAnonymous($email, $firstName, $lastName, array $optionals = [])
    {
        $optionalValues = [
            'studentNote'    => null,
            'durationWeeks'  => null,
            'cityId'         => null,
            'schoolId'       => null,
            'schoolCourseId' => null,
            'courseTypeId'   => null,
        ];

        ArrayHelper::assocIndexesExist($optionals, $optionalValues);
        $optionalValues = array_replace_recursive($optionalValues, $optionals);

        $data = [
            'lead' => [
                'createdBy'     => [
                    'email'   => $email,
                    'profile' => [
                        'firstName' => $firstName,
                        'lastName'  => $lastName,
                    ],
                ],
                'dateStart'     => date('Y-m-d'),
                'durationWeeks' => $optionalValues['durationWeeks'],
                'studentNote'   => $optionalValues['studentNote'],
            ],
        ];

        if ($optionalValues['cityId']) {
            $data['city']['id'] = $optionalValues['cityId'];
        }

        if ($optionalValues['courseTypeId']) {
            $data['courseType']['id'] = $optionalValues['courseTypeId'];
        }

        if ($optionalValues['schoolId']) {
            $data['school']['id'] = $optionalValues['schoolId'];
        }

        if ($optionalValues['schoolCourseId']) {
            $data['schoolCourse']['id'] = $optionalValues['schoolCourseId'];
        }

        $request = new Request('pub/leads', 'POST', $data);

        return $this->client->sendRequest($request);
    }
}