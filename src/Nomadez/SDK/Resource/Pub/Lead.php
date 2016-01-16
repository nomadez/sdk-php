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
            'studentNote'   => null,
            'durationWeeks' => null,
        ];

        ArrayHelper::assocIndexesExist($optionalValues, $optionals);
        $optionalValues = array_replace_recursive($optionalValues, $optionals);

        $request = new Request('pub/leads', 'POST', [
            'lead' => [
                'createdBy'     => [
                    'email'   => $email,
                    'profile' => [
                        'firstName' => $firstName,
                        'lastName'  => $lastName,
                    ],
                ],
                'city'          => [
                    'id' => 1 // dublin
                ],
                'courseType'    => [
                    'id' => 1,
                ],
                'dateStart'     => date('Y-m-d'),
                'durationWeeks' => $optionalValues['durationWeeks'],
                'studentNote'   => $optionalValues['studentNote'],
            ],
        ]);

        return $this->client->sendRequest($request);
    }
}