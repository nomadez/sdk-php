<?php

namespace Nomadez\SDK\Resource;

use Nomadez\SDK\Exception\ResourceException;
use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class User
 *
 * @package Nomadez\SDK\Resource
 * @author  Andreas Glaser
 */
class User extends Resource
{
    public function get($userId = null)
    {
        $userId = $userId ? $userId : $this->client->getConfigValue('user.id');

        if (!$userId) {
            throw new ResourceException('User id not provided');
        }

        $request = new Request('users/' . $userId, 'GET');

        return $this->client->sendRequest($request);
    }

    public function edit(array $payload, $userId = null)
    {
        $request = new Request('users' . $userId ? $userId : $this->userId, 'PUT', $payload);

        return $this->client->sendRequest($request);
    }
}