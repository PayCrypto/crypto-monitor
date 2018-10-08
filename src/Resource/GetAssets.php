<?php
declare(strict_types=1);

namespace PayCrypto\Resource;

use PayCrypto\PayCrypto;
use PayCrypto\CryptoMonitor;
use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Provider\Patreon\Collection\PledgeRecords;
use ScriptFUSION\Porter\Provider\Patreon\PatreonProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class GetAssets implements ProviderResource
{
    public $config;

    public function __construct(PayCrypto $config)
    {
        $this->config = $config;
    }

    public function getProviderClassName(): string
    {
        return CryptoMonitor::class;
    }

    public function fetch(ImportConnector $connector): \Iterator
    {
        $response = (string) $connector->fetch(
            CryptoMonitor::buildExchangeApiUrl($this->config)
        );

        $data = json_decode($response, true);

        $assets = new \ArrayIterator($data);

        return new CountableProviderRecords($assets, count($assets), $this);
    }
}
