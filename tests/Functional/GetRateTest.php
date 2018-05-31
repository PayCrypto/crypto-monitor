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

        $this->assertSame('BTC', $rates->getBase());
        $this->assertSame('USD', $rates->getQuote());
        $this->assertLessThanOrEqual(time(), strtotime($rates->getTime()));
        $this->assertInternalType('float', $rates->getRate());
    }

    public function testGetAllRateRecords()
    {
        /** @var AllRatesRecord $rates */
        $rates = FixtureFactory::createPorter()->import(new ImportSpecification(new GetAllRate($this->apiKey)))
            ->findFirstCollection();

        $base = $rates->getBase();
        $quote = $rates->getQuote();
        $time = $rates->getTime();
        $rate = $rates->getRate();

        $this->assertSame('BTC', $base);
        $this->assertContains('USD', $quote);
        $this->assertContains('GBP', $quote);
        $this->assertContains('EUR', $quote);
        $this->assertLessThanOrEqual(time(), strtotime($time[0]));
        $this->assertInternalType('float', $rate[0]);
    }
}
