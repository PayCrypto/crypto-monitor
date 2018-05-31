<?php

require_once __DIR__ . '/vendor/autoload.php';

use Joomla\DI\Container;
use ScriptFUSION\Porter\Porter;
use PayCrypto\CryptoMonitor;
use PayCrypto\Connector\CryptoConnector;
use PayCrypto\Resource\GetSpecificRate;
use ScriptFUSION\Porter\Specification\ImportSpecification;

$apiKey = '4E861687-19D6-4894-87B9-E785B1EE3900';

$container = new Container;
$container->set(CryptoMonitor::class, new CryptoMonitor(new CryptoConnector($apiKey)));
$porter = new Porter($container);
$rates = $porter->import(new ImportSpecification(new GetSpecificRate($apiKey)))
    ->findFirstCollection();

echo $rates->getBase();
echo PHP_EOL;

echo $rates->getQuote();
echo PHP_EOL;

echo $rates->getTime();
echo PHP_EOL;

echo $rates->getRate();
echo PHP_EOL;
