<?php

namespace Nomadez\SDK;

use Faker;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class BaseTestCase
 *
 * @package Nomadez\SDK
 * @author  Andreas Glaser
 */
class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Nomadez\SDK\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $config;

    protected $faker;

    /**
     * BaseTestCase constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     *
     * @author Andreas Glaser
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->config = parse_ini_file(__DIR__ . '/../../config.ini', true);

        // overwrite default configuration with custom values if available
        if (file_exists(__DIR__ . '/../../config-custom.ini') && is_readable(__DIR__ . '/../../config-custom.ini')) {
            $configCustom = parse_ini_file(__DIR__ . '/../../config-custom.ini', true);
            $this->config = array_replace_recursive($this->config, $configCustom);
        }

        $config = $this->config['client'];
        $config['headers'] = $this->config['client.headers'];

        $this->client = new Client($config);

        // attach logger if necessary

        if ($this->config['general']['logging.enabled']) {
            $logger = new Logger('default');
            $handler = new StreamHandler(__DIR__ . '/../../logs/client.log');
            $handler->setFormatter(new LineFormatter(null, null, true));
            $logger->pushHandler($handler);

            $this->client->attachLogger($logger);
        }

        $this->faker = Faker\Factory::create();
    }
}