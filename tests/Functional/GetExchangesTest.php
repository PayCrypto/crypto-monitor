<?php
declare(strict_types=1);

namespace PayCrypto\Tests;

use PHPUnit\Framework\TestCase;
use PayCrypto\Resource\GetExchanges;
use PayCrypto\Collection\ExchangesRecord;
use ScriptFUSION\Porter\Specification\ImportSpecification;

final class GetExchangesTest extends TestCase
{
    private $apiKey = '';

    public function testGetExchanges()
    {
        $this->apiKey = getenv('COIN_API_KEY');

        /** @var ExchangesRecord */
        $exchanges = FixtureFactory::createPorter()->import(new ImportSpecification(new GetExchanges($this->apiKey)));

        foreach ($exchanges as $exchangeRecord) {
            $this->assertArrayHasKey('exchange_id', $exchangeRecord);
            $this->assertArrayHasKey('website', $exchangeRecord);
            $this->assertArrayHasKey('name', $exchangeRecord);
        }
    }
}
