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
        /** @var \ArrayIterator $rates */
        $rate = FixtureFactory::createPorter()->import(new ImportSpecification(new GetSpecificRate($this->apiKey)));

        $this->assertCount(1, $rate);

        $rateRecords = iterator_to_array($rate);

        foreach($rateRecords as $rateRecord) {
            $this->assertArrayHasKey('asset_id_base', $rateRecord);
            $this->assertArrayHasKey('asset_id_quote', $rateRecord);
            $this->assertArrayHasKey('rate', $rateRecord);
            $this->assertArrayHasKey('time', $rateRecord);
        }
    }

    public function testGetAllRateRecords()
    {
        /** @var AllRatesRecord $rates */
        $rates = FixtureFactory::createPorter()->import(new ImportSpecification(new GetAllRate($this->apiKey)));

        $rates = $rates->findFirstCollection();
        $rateRecords = iterator_to_array($rates);

        $this->assertSame('BTC', $rates->getBase());

        foreach ($rateRecords as $rateRecord) {
            $this->assertArrayHasKey('asset_id_quote', $rateRecord);
            $this->assertArrayHasKey('rate', $rateRecord);
            $this->assertArrayHasKey('time', $rateRecord);
        }
    }
}
