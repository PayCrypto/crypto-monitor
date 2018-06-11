<?php
declare(strict_types=1);

namespace PayCrypto\Tests;

use PHPUnit\Framework\TestCase;
use PayCrypto\Resource\GetSpecificRate;
use PayCrypto\Resource\GetAllRate;
use PayCrypto\Collection\SpecificRateRecord;
use PayCrypto\Collection\AllRatesRecord;
use ScriptFUSION\Porter\Specification\ImportSpecification;

final class GetRateTest extends TestCase
{
    private $apiKey = '';

    public function testGetSpecificRateRecords()
    {
        $this->apiKey = getenv('COIN_API_KEY');

        $rate = FixtureFactory::createPorter()->importOne(new ImportSpecification(new GetSpecificRate($this->apiKey)));

        $this->assertArrayHasKey('asset_id_base', $rate);
        $this->assertArrayHasKey('asset_id_quote', $rate);
        $this->assertArrayHasKey('rate', $rate);
        $this->assertArrayHasKey('time', $rate);
    }

    public function testGetAllRateRecords()
    {
        /** @var AllRatesRecord $rates */
        $rates = FixtureFactory::createPorter()->import(new ImportSpecification(new GetAllRate($this->apiKey)));

        $this->assertGreaterThan(1000, count($rates));

        foreach ($rates as $rateRecord) {
            $this->assertArrayHasKey('asset_id_quote', $rateRecord);
            $this->assertArrayHasKey('rate', $rateRecord);
            $this->assertArrayHasKey('time', $rateRecord);
        }

        $rates = $rates->findFirstCollection();
        $this->assertSame('BTC', $rates->getBase());
    }
}
