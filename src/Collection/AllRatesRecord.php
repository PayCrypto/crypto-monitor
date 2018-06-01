<?php
declare(strict_types=1);

namespace PayCrypto\Collection;

use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class AllRatesRecord extends CountableProviderRecords
{
    private $base;

    public function __construct(
        \Iterator $providerRecords,
        string $base,
        int $count,
        ProviderResource $resource
    ) {
        parent::__construct($providerRecords, $count, $resource);

        $this->base = $base;
    }

    public function getBase(): string
    {
        return $this->base;
    }

    public function toAssociativeArray(): array
    {
        return iterator_to_array($this);
    }
}
