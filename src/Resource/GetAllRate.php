<?php
declare(strict_types=1);

namespace PayCrypto\Resource;

use PayCrypto\PayCrypto;
use PayCrypto\CryptoMonitor;
use PayCrypto\Collection\AllRatesRecord;
use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Provider\Patreon\Collection\PledgeRecords;
use ScriptFUSION\Porter\Provider\Patreon\PatreonProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class GetAllRate implements ProviderResource
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

        $rates = new \ArrayIterator($data['rates']);

        return new AllRatesRecord($rates, $this->config->base, count($rates), $this);
    }
}
