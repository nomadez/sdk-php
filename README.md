#Nomadez SDK - PHP
Nomadez SDK written in PHP

##Installation
```bash
composer require nomadez/sdk-php dev-master
```

##Usage
```php
use Nomadez\SDK\Client;
use Nomadez\SDK\Resource as Resource;

$client = new Client();

$userPubResource = new Resource\Pub\User($client);

$response = $userPubResource->auth(
    'user@example.com',
    'superSecurePassword1'
);

$payload = $response->getBodyDecoded();
```