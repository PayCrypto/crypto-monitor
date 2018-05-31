<?php

require_once __DIR__ . '/vendor/autoload.php';

use Joomla\DI\Container;
use ScriptFUSION\Porter\Porter;
use PayCrypto\CryptoMonitor;
use PayCrypto\Connector\CryptoConnector;
use PayCrypto\Resource\GetSpecificRate;
use PayCrypto\Resource\GetAllRate;
use ScriptFUSION\Porter\Specification\ImportSpecification;

// Get specific rate

$apiKey = '4E861687-19D6-4894-87B9-E785B1EE3900';

$container = new Container;
$container->set(CryptoMonitor::class, new CryptoMonitor(new CryptoConnector($apiKey)));
$porter = new Porter($container);
$specificRate = new GetSpecificRate($apiKey);
$specificRate->base = 'BTC';
$specificRate->quote = 'USD';

$rates = $porter->import(new ImportSpecification($specificRate))
    ->findFirstCollection();

echo $rates->getBase();
echo PHP_EOL;

echo $rates->getQuote();
echo PHP_EOL;

echo $rates->getTime();
echo PHP_EOL;

echo $rates->getRate();
echo PHP_EOL;

// Get all rates

$container = new Container;
$container->set(CryptoMonitor::class, new CryptoMonitor(new CryptoConnector($apiKey)));
$porter = new Porter($container);
$specificRate = new GetAllRate($apiKey);
$specificRate->base = 'BTC';

$rates = $porter->import(new ImportSpecification($specificRate))
    ->findFirstCollection();

echo $rates->getBase(); // BTC
echo PHP_EOL;

var_dump($rates->getQuote()); // array
echo PHP_EOL;

var_dump($rates->getTime()); // array
echo PHP_EOL;

var_dump($rates->getRate()); // rate
echo PHP_EOL;
