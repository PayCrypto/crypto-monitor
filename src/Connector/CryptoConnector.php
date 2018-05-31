<?php
declare(strict_types=1);

namespace PayCrypto\Connector;

use ScriptFUSION\Porter\Net\Http\HttpConnector;
use ScriptFUSION\Porter\Net\Http\HttpOptions;

class CryptoConnector extends HttpConnector
{
    private $options;

    public function __construct(string $apiKey)
    {
        $buildHeader = sprintf("X-CoinAPI-Key: %s", $apiKey);

        parent::__construct($this->options = (new HttpOptions)->addHeader($buildHeader));
    }
}
