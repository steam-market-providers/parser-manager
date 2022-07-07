<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser;

use KrepyshSpec\SteamMarketParser\Contract\FactoryInterface;

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