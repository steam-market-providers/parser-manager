<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Contract;

use SteamMarketProviders\ParserManager\SteamParser;

interface FactoryInterface
{
    public static function create(): SteamParser;
}
