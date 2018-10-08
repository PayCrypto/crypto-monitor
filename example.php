<?php
require_once __DIR__ . '/vendor/autoload.php';

use PayCrypto\PayCrypto;

$provider = 'coinapi';

$apiKey = '4E861687-19D6-4894-87B9-E785B1EE3900';

$payCrypto = new PayCrypto($provider, $apiKey);

// Get specific rate
$rates = $payCrypto->getSpecificRate('ETH', 'EUR');

var_dump($rates);

// Get all rates

$rates = $payCrypto->getAllRate('ETH');

foreach ($rates as $rateRecord) {
    echo $rateRecord['asset_id_quote'] . PHP_EOL;
    echo $rateRecord['rate'] . PHP_EOL;
    echo $rateRecord['time'] . PHP_EOL;
}

// Get the base id

echo PHP_EOL;
$rates = $rates->findFirstCollection();
echo $rates->getBase(); //ETH

// Get Assets

$assets = $payCrypto->getAssets();

foreach ($assets as $assetRecord) {
    var_dump($assetRecord['asset_id']);
    var_dump($assetRecord['name']);
    var_dump($assetRecord['type_is_crypto']);
}
