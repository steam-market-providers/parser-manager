<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager;

use SteamMarketProviders\ParserManager\Contract\FactoryInterface;
use SteamMarketProviders\ParserManager\Parser\SteamParser;

final class SteamParserFactory implements FactoryInterface
{
    /**
     * @return SteamParser
     */
    public static function create(): SteamParser
    {
        return new SteamParser();
    }
}
