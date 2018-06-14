<?php

require_once __DIR__ . '/vendor/autoload.php';

use Joomla\DI\Container;
use ScriptFUSION\Porter\Porter;
use PayCrypto\CryptoMonitor;
use PayCrypto\Connector\CryptoConnector;
use PayCrypto\Resource\GetSpecificRate;
use PayCrypto\Resource\GetAllRate;
use PayCrypto\Resource\GetAssets;
use ScriptFUSION\Porter\Specification\ImportSpecification;

// Get specific rate

$apiKey = 'your-coin-api-key';

$container = new Container;
$container->set(CryptoMonitor::class, new CryptoMonitor(new CryptoConnector($apiKey)));
$porter = new Porter($container);
$specificRate = new GetSpecificRate($apiKey, 'BTC', 'USD');

$rates = $porter->importOne(new ImportSpecification($specificRate));

var_dump($rates);

// Get all rates

$container = new Container;
$container->set(CryptoMonitor::class, new CryptoMonitor(new CryptoConnector($apiKey)));
$porter = new Porter($container);
$specificRate = new GetAllRate($apiKey, 'BTC');

$rates = $porter->import(new ImportSpecification($specificRate));

foreach ($rates as $rateRecord) {
    echo $rateRecord['asset_id_quote'] . PHP_EOL;
    echo $rateRecord['rate'] . PHP_EOL;
    echo $rateRecord['time'] . PHP_EOL;
}

// Get the base id

echo PHP_EOL;

$rates = $rates->findFirstCollection();
echo $rates->getBase(); //BTC

// Get Assets

$container = new Container;
$container->set(CryptoMonitor::class, new CryptoMonitor(new CryptoConnector($apiKey)));
$porter = new Porter($container);
$assets = new GetAssets($apiKey);

$assets = $porter->import(new ImportSpecification($assets));

foreach ($assets as $assetRecord) {
    var_dump($assetRecord['asset_id']);
    var_dump($assetRecord['name']);
    var_dump($assetRecord['type_is_crypto']);
}
