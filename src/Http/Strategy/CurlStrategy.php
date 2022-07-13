<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Http\Strategy;

use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Http\Options;
use SteamMarketProviders\ParserManager\Http\Response;

class CurlStrategy implements StrategyInterface
{
    /**
     * @param Options|null $options
     */
    public function __construct(null|Options $options = null)
    {
    }

    /**
     * @param string $url
     * @return Response
     */
    public function sendRequest(string $url): Response
    {
        // TODO: Implement sendRequest() method.
    }
}
