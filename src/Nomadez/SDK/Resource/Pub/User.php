<?php

namespace Nomadez\SDK\Resource\Pub;

use Nomadez\SDK\Request;
use Nomadez\SDK\Resource;

/**
 * Class User
 *
 * @package Nomadez\SDK\Resource\Pub
 * @author  Andreas Glaser
 */
class User extends Resource
{
    /**
     * Authenticates user credentials and returns new API key.
     *
     * @param string $email
     * @param string $plainPassword
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function auth($email, $plainPassword)
    {
        $request = new Request('pub/users/auth', 'POST', [
            'user' => [
                'email'          => $email,
                'plain_password' => $plainPassword,
            ],
        ]);

        return $this->client->sendRequest($request);
    }
}