<?php

namespace PayCrypto\Tests;

use Psr\Container\ContainerInterface;
use ScriptFUSION\Porter\Porter;
use PayCrypto\Connector\CryptoConnector;
use PayCrypto\CryptoMonitor;
use ScriptFUSION\StaticClass;

final class FixtureFactory
{
    use StaticClass;

    public static function createPorter(): Porter
    {
        return new Porter(
            \Mockery::mock(ContainerInterface::class)
                ->shouldReceive('has')
                    ->with(CryptoMonitor::class)
                    ->andReturn(true)
                ->shouldReceive('get')
                    ->with(CryptoMonitor::class)
                    ->andReturn(new CryptoMonitor(new CryptoConnector('4E861687-19D6-4894-87B9-E785B1EE3900')))
                ->getMock()
        );
    }
}
