<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Contract;

use SteamMarketProviders\ParserManager\Http\Options;
use SteamMarketProviders\ParserManager\Http\Response;

interface StrategyInterface
{
    /**
     * @param Options|null $options
     */
    public function __construct(null|Options $options = null);

    /**
     * @param string $url
     * @return Response
     */
    public function sendRequest(string $url): Response;
}
