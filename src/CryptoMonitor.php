<?php
declare(strict_types=1);

namespace PayCrypto;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Provider\Provider;

class CryptoMonitor implements Provider
{
    public const EXCHANGE_API_ENDPOINT = 'https://rest.coinapi.io/';

    private $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public static function buildExchangeApiUrl(string $url): string
    {
        return self::EXCHANGE_API_ENDPOINT . $url;
    }

    public function getConnector(): Connector
    {
        return $this->connector;
    }
}
