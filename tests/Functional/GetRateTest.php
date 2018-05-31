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
    /** @var $apiKey This is the Coin API Key for test environment*/
    private $apiKey = '4E861687-19D6-4894-87B9-E785B1EE3900';

    public function testGetSpecificRateRecords()
    {
        /** @var SpecificRateRecord $rates */
        $rates = FixtureFactory::createPorter()->import(new ImportSpecification(new GetSpecificRate($this->apiKey)))
            ->findFirstCollection();

        $rateRecords = $rates->toAssociativeArray();

        $this->assertCount(1, $rateRecords);
        $this->assertArrayHasKey('asset_id_base', $rateRecords[0]);
        $this->assertArrayHasKey('asset_id_quote', $rateRecords[0]);
        $this->assertArrayHasKey('rate', $rateRecords[0]);
        $this->assertArrayHasKey('time', $rateRecords[0]);
    }

    public function testGetAllRateRecords()
    {
        /** @var AllRatesRecord $rates */
        $rates = FixtureFactory::createPorter()->import(new ImportSpecification(new GetAllRate($this->apiKey)))
            ->findFirstCollection();

        $this->assertSame('BTC', $rates->getBase());

        $rateRecords = $rates->toAssociativeArray();

        $this->assertArrayHasKey('asset_id_quote', $rateRecords[0]);
        $this->assertArrayHasKey('rate', $rateRecords[0]);
        $this->assertArrayHasKey('time', $rateRecords[0]);
    }
}
