<?php
declare(strict_types=1);

namespace PayCrypto\Tests;

use PHPUnit\Framework\TestCase;
use PayCrypto\Resource\GetAssets;
use PayCrypto\Collection\AssetsRecord;
use ScriptFUSION\Porter\Specification\ImportSpecification;

final class GetAssetsTest extends TestCase
{
    /** @var $apiKey This is the Coin API Key for test environment*/
    private $apiKey = '4E861687-19D6-4894-87B9-E785B1EE3900';

    public function testGetAssets()
    {
        /** @var AssetsRecord */
        $assets = FixtureFactory::createPorter()->import(new ImportSpecification(new GetAssets($this->apiKey)));

        foreach ($assets as $assetRecord) {
            $this->assertArrayHasKey('asset_id', $assetRecord);
            $this->assertArrayHasKey('name', $assetRecord);
            $this->assertArrayHasKey('type_is_crypto', $assetRecord);
        }
    }
}
