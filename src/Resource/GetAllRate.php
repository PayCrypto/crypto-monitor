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

    public $base = 'BTC';

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
                    sprintf("v1/exchangerate/%s", $this->base)
                )
            ),
            true
        );

        $rates = $response['rates'];
        $base = $response['asset_id_base'];
        $quote = [];
        $rate = [];
        $time = [];

        foreach($rates as $key => $value) {
            $quote[] = $rates[$key]['asset_id_quote'];
            $rate[] = $rates[$key]['rate'];
            $time[] = $rates[$key]['time'];
        }

        return new AllRatesRecord($time, $base, $quote, $rate);
    }
}
