<?php
declare(strict_types=1);

namespace PayCrypto\Collection;

use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class AllRatesRecord extends CountableProviderRecords
{
    private $base;

    private $time;

    private $quote;

    private $rate;

    public function __construct(array $time, string $base, array $quote, array $rate)
    {
        $this->base = $base;
        $this->time = $time;
        $this->quote = $quote;
        $this->rate = $rate;
    }

    public function getBase(): string
    {
        return $this->base;
    }

    public function getTime(): array
    {
        return $this->time;
    }

    public function getQuote(): array
    {
        return $this->quote;
    }

    public function getRate(): array
    {
        return $this->rate;
    }
}
