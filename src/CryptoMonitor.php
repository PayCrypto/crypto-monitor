<?php

declare(strict_types=1);
namespace PayCrypto;

use PayCrypto\PayCrypto;
use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Provider\Provider;

class CryptoMonitor implements Provider
{
    private $connector;

    private static $providers = [
        'coinapi' => [
            'url' => 'https://rest.coinapi.io/v1/',
            'specific' => 'exchangerate/%s/%s/',
            'all' => 'exchangerate/%s/',
            'assets' => 'assets/'
        ]
    ];

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public static function buildExchangeApiUrl(PayCrypto $config) : string
    {
        $url = self::$providers[$config->provider]['url'];

        $params = self::$providers[$config->provider][$config->type];

        switch ($config->type) {
            case 'specific':
                $url .= sprintf($params, $config->base, $config->quote);
                break;
            case 'all':
                $url .= sprintf($params, $config->base);
                break;
            case 'assets':
                $url .= $params;
                break;
            default:
                break;
        }

        return $url;
    }

    public function getConnector() : Connector
    {
        return $this->connector;
    }
}
