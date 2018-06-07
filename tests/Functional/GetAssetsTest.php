<?php
declare(strict_types=1);

namespace PayCrypto\Tests;

use PHPUnit\Framework\TestCase;
use PayCrypto\Resource\GetAssets;
use PayCrypto\Collection\AssetsRecord;
use ScriptFUSION\Porter\Specification\ImportSpecification;

final class GetAssetsTest extends TestCase
{
    private $apiKey = '';

    public function testGetAssets()
    {
        $this->apiKey = getenv('COIN_API_KEY');

        /** @var AssetsRecord */
        $assets = FixtureFactory::createPorter()->import(new ImportSpecification(new GetAssets($this->apiKey)));

        foreach ($assets as $assetRecord) {
            $this->assertArrayHasKey('asset_id', $assetRecord);
            $this->assertArrayHasKey('name', $assetRecord);
            $this->assertArrayHasKey('type_is_crypto', $assetRecord);
        }
    }
}
