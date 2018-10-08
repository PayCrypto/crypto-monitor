<?php
declare(strict_types=1);

namespace PayCrypto\Resource;

use PayCrypto\PayCrypto;
use PayCrypto\CryptoMonitor;
use PayCrypto\Collection\SpecificRateRecord;
use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Provider\Patreon\Collection\PledgeRecords;
use ScriptFUSION\Porter\Provider\Patreon\PatreonProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class GetSpecificRate implements ProviderResource
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
        $json = (string) $connector->fetch(
            CryptoMonitor::buildExchangeApiUrl($this->config)
        );

        yield json_decode($json, true);
    }
}
