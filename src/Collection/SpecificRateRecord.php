<?php
declare(strict_types=1);

namespace PayCrypto\Collection;

use ScriptFUSION\Porter\Collection\CountableProviderRecords;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;

class SpecificRateRecord extends CountableProviderRecords
{
    private $base;

    private $time;

    private $quote;

    private $rate;

    public function __construct(string $time, string $base, string $quote, float $rate)
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

    public function getTime(): string
    {
        return $this->time;
    }

    public function getQuote(): string
    {
        return $this->quote;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}
