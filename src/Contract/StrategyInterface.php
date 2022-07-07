<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Contract;

use SteamMarketProviders\ParserManager\Http\HttpOptions;

interface StrategyInterface
{
    /**
     * @param HttpOptions|null $options
     */
    public function __construct(null|HttpOptions $options = null);

    /**
     * @param string $url
     * @return string
     */
    public function sendRequest(string $url): string;
}