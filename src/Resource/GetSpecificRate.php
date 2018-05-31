<?php
declare(strict_types=1);

namespace PayCrypto\Resource;

use PayCrypto\CryptoMonitor;
use PayCrypto\Collection\SpecificRateRecord;
use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Provider\Patreon\Collection\PledgeRecords;
use ScriptFUSION\Porter\Provider\Patreon\PatreonProvider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class GetSpecificRate implements ProviderResource
{
    private $apiKey;

    public $base = 'BTC';

    public $quote = 'USD';

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
                    sprintf("v1/exchangerate/%s/%s", $this->base, $this->quote)
                )
            ),
            true
        );

        $base = $response['asset_id_base'];

        $quote = $response['asset_id_quote'];
        $rate = $response['rate'];
        $time = $response['time'];

        return new SpecificRateRecord($time, $base, $quote, $rate);
    }
}
