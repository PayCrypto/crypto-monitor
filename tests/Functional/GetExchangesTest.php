<?php
declare(strict_types=1);

namespace PayCrypto\Tests;

use PHPUnit\Framework\TestCase;
use PayCrypto\Resource\GetExchanges;
use PayCrypto\Collection\ExchangesRecord;
use ScriptFUSION\Porter\Specification\ImportSpecification;

final class GetExchangesTest extends TestCase
{
    /** @var $apiKey This is the Coin API Key for test environment*/
    private $apiKey = '4E861687-19D6-4894-87B9-E785B1EE3900';

    public function testGetExchanges()
    {
        /** @var ExchangesRecord */
        $exchanges = FixtureFactory::createPorter()->import(new ImportSpecification(new GetExchanges($this->apiKey)));

        foreach ($exchanges as $exchangeRecord) {
            $this->assertArrayHasKey('exchange_id', $exchangeRecord);
            $this->assertArrayHasKey('website', $exchangeRecord);
            $this->assertArrayHasKey('name', $exchangeRecord);
        }
    }
}
