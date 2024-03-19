<?php

namespace App\Libs\SpApi;

use AmazonPHP\SellingPartner\Configuration;
use AmazonPHP\SellingPartner\Exception\ApiException;
use AmazonPHP\SellingPartner\Marketplace;
use AmazonPHP\SellingPartner\Regions;
use AmazonPHP\SellingPartner\SellingPartnerSDK;
use Core\Configurable;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Nyholm\Psr7\Factory\Psr17Factory;

class Sdk extends Configurable
{
    protected $sdk;

    public function __construct()
    {
        parent::__construct();

        $config = self::$config['amazon_sp_api'];
        $factory = new Psr17Factory();
        $client = new Client();

        $configuration = Configuration::forIAMUser(
            $config['credentials']['lwa_client_id'],
            $config['credentials']['lwa_client_secret'],
            $config['credentials']['aws_access_key_id'],
            $config['credentials']['aws_secret_access_key']
        );
        if (!empty($config['details']['sandbox'])) {
            $configuration->setSandbox();
        }

        $logger = new Logger('name');
        $logger->pushHandler(new StreamHandler('\logs\sp-api.log', Logger::DEBUG));

        $this->sdk = SellingPartnerSDK::create($client, $factory, $factory, $configuration, $logger);
    }
}
