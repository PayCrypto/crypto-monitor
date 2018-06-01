<?php
declare(strict_types=1);

namespace PayCrypto\Collection;

use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class SpecificRateRecord extends CountableProviderRecords
{
    public function __construct(
        \Iterator $providerRecords,
        int $count,
        ProviderResource $resource
    ) {
        parent::__construct($providerRecords, $count, $resource);
    }

    public function toAssociativeArray(): array
    {
        return iterator_to_array($this);
    }
}
