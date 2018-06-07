<?php
declare(strict_types=1);

namespace PayCrypto\Resource;

use PayCrypto\CryptoMonitor;
use PayCrypto\Collection\AllRatesRecord;
use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Provider\Patreon\Collection\PledgeRecords;
use ScriptFUSION\Porter\Provider\Patreon\PatreonProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class GetAllRate implements ProviderResource
{
    private $apiKey;

    private $base;

    public function __construct(string $apiKey, string $base = 'BTC')
    {
        $this->apiKey = $apiKey;
        $this->base = $base;
    }

    public function getProviderClassName(): string
    {
        return CryptoMonitor::class;
    }

    public function fetch(ImportConnector $connector): \Iterator
    {
        $response = \json_decode(
            (string) $connector->fetch(
                CryptoMonitor::buildExchangeApiUrl(
                    sprintf("v1/exchangerate/%s", $this->base)
                )
            ),
            true
        );

        $rates = new \ArrayIterator($response['rates']);

        return new AllRatesRecord($rates, $this->base, count($rates), $this);
    }
}
