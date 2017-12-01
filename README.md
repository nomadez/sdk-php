# Nomadez SDK - PHP
Nomadez SDK written in PHP

## Installation
```shell
composer require nomadez/sdk-php dev-master
```

##Usage
```php
use Nomadez\SDK\Client;
use Nomadez\SDK\Resource as Resource;

$client = new Client();

// authenticate credentials and receive api key

$userPubResource = new Resource\Pub\User($client);

$response = $userPubResource->auth(
    'user@example.com',
    'superSecurePassword1'
);

$payload = $response->getBodyDecoded();

$client->setApiKey($payload['api_key']);
```
