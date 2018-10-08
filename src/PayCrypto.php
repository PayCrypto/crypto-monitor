<?php

declare(strict_types=1);
namespace PayCrypto;

use Joomla\DI\Container;
use PayCrypto\Connector\CryptoConnector;
use PayCrypto\CryptoMonitor;
use PayCrypto\Resource\GetAllRate;
use PayCrypto\Resource\GetAssets;
use PayCrypto\Resource\GetSpecificRate;
use ScriptFUSION\Porter\Porter;
use ScriptFUSION\Porter\Specification\ImportSpecification;

class PayCrypto
{
    public $provider;

    public $apiKey;

    public $porter;

    public $base;

    public $quote;

    public function __construct(string $provider, string $apiKey)
    {
        $this->provider = $provider;
        $this->apiKey = $apiKey;

        $this->porter = new Porter(
            $this->setContainer()
        );
    }

    public function getSpecificRate(string $base = 'BTC', string $quote = 'USD') : array
    {
        $this->base = $base;
        $this->quote = $quote;
        $this->type = 'specific';

        return $this->porter->importOne(
            new ImportSpecification(
                new GetSpecificRate($this)
            )
        );
    }

    public function getAllRate(string $base = 'BTC') : object
    {
        $this->base = $base;
        $this->type = 'all';

        return $this->porter->import(
            new ImportSpecification(
                new GetAllRate($this)
            )
        );
    }

    public function getAssets() : object
    {
        $this->type = 'assets';

        return $this->porter->import(
            new ImportSpecification(
                new GetAssets($this)
            )
        );
    }

    public function getConnector() : Connector
    {
        return $this->connector;
    }

    private function setContainer()
    {
        $container = new Container;

        return $container->set(
            CryptoMonitor::class,
            new CryptoMonitor(
                new CryptoConnector($this->apiKey)
            )
        );
    }
}
