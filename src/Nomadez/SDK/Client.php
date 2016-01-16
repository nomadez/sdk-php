<?php

namespace Nomadez\SDK;

use AndreasGlaser\Helpers\ArrayHelper;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception as GuzzleException;
use Nomadez\SDK\Exception\ClientException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class Client
 *
 * @package Nomadez\SDK
 * @author  Andreas Glaser
 */
class Client
{
    /**
     * @var LoggerInterface[]
     */
    protected $loggers = [];

    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzleHttpClient;

    /**
     * @var array
     */
    protected $config = [
        'api.url'                => 'http://nomadez.com/api/',
        'api.key.header'         => 'X-API-KEY',
        'client.timeout'         => 60,
        'client.connect_timeout' => 10,
        'request.timeout'        => 20,
        'user.id'                => null,
        'headers'                => [],
    ];

    /**
     * @var string|null
     */
    protected $apiKey;

    /**
     * Client constructor.
     *
     * @param array $config
     * @param null  $apiKey
     *
     * @author Andreas Glaser
     */
    public function __construct(array $config = [], $apiKey = null)
    {
        ArrayHelper::assocIndexesExist($config, $this->config, true);
        $this->config = array_replace_recursive($this->config, $config);

        if (!empty($apiKey)) {
            $this->setApiKey($apiKey);
        }

        $this->guzzleHttpClient = new GuzzleClient();
    }

    /**
     * @param \Nomadez\SDK\Request $request
     *
     * @return \Nomadez\SDK\Response
     * @author Andreas Glaser
     */
    public function sendRequest(Request $request)
    {
        $headers = $this->config['headers'];

        if ($this->apiKey) {
            $headers[$this->config['api.key.header']] = $this->apiKey;
        }

        $headers = array_replace_recursive($headers, $request->getHeaders());

        try {

            $data = [
                'method'  => $request->getMethod(),
                'url'     => $this->config['api.url'] . $request->getUri() . '.json',
                'options' => [
                    'headers'         => $headers,
                    'timeout'         => $this->config['client.timeout'],
                    'connect_timeout' => $this->config['client.connect_timeout'],
                    'allow_redirects' => true,
                    'body'            => $request->getPayload(),
                ],
            ];

            $this->log(LogLevel::DEBUG, $data);

            $data['options']['body'] = json_encode($data['options']['body']);

            $response = $this->guzzleHttpClient->request(
                $data['method'],
                $data['url'],
                $data['options']
            );

        } catch (GuzzleException\ServerException $e) {
            $response = $e->getResponse();
        } catch (GuzzleException\ClientException $e) {
            $response = $e->getResponse();
        }

        $bodyRaw = $response->getBody()->getContents();
        $bodyDecoded = json_decode($bodyRaw);

        $log = [
            'statusCode' => $response->getStatusCode(),
            'headers'    => $response->getHeaders(),
            'body'       => $bodyDecoded,
        ];

        $this->log(LogLevel::DEBUG, $log);

        return new Response(
            $response->getStatusCode(),
            $bodyRaw,
            $response->getHeaders()
        );
    }

    /**
     * @return null|string
     * @author Andreas Glaser
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param null|string $apiKey
     *
     * @return Client
     * @author Andreas Glaser
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = (string)$apiKey;

        return $this;
    }

    /**
     * @return $this
     * @author Andreas Glaser
     */
    public function removeApiKey()
    {
        $this->apiKey = null;

        return $this;
    }

    /**
     * @return array
     * @author Andreas Glaser
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param $name
     *
     * @return mixed
     * @throws \Nomadez\SDK\Exception\ClientException
     * @author Andreas Glaser
     */
    public function getConfigValue($name)
    {
        if (!array_key_exists($name, $this->config)) {
            throw new ClientException(sprintf('Config parameter "%s" does not exist', $name));
        }

        return $this->config[$name];
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     *
     * @return $this
     * @author Andreas Glaser
     */
    public function attachLogger(LoggerInterface $logger)
    {
        $this->loggers[spl_object_hash($logger)] = $logger;

        return $this;
    }

    /**
     * @param       $level
     * @param       $message
     * @param array $context
     *
     * @return $this
     * @author Andreas Glaser
     */
    public function log($level, $message, array $context = [])
    {
        if (!is_scalar($message)) {
            $message = print_r($message, true);
        }

        foreach ($this->loggers AS $logger) {
            $logger->log($level, $message, $context);
        }

        return $this;
    }
}
