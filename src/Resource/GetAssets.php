<?php
declare(strict_types=1);

namespace PayCrypto\Resource;

use PayCrypto\CryptoMonitor;
use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Provider\Patreon\Collection\PledgeRecords;
use ScriptFUSION\Porter\Provider\Patreon\PatreonProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class GetAssets implements ProviderResource
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
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
                    'v1/assets'
                )
            ),
            true
        );

        $assets = new \ArrayIterator($response);

        return new CountableProviderRecords($assets, count($assets), $this);
    }
}
