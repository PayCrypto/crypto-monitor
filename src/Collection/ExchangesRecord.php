<?php
declare(strict_types=1);

namespace PayCrypto\Collection;

use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class ExchangesRecord extends CountableProviderRecords
{
    public function __construct(
        \Iterator $providerRecords,
        int $count,
        ProviderResource $resource
    ) {
        parent::__construct($providerRecords, $count, $resource);
    }
}
