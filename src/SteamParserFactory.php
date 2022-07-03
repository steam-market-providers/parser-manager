<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser;

use KrepyshSpec\SteamMarketParser\Interfaces\FactoryInterface;

final class SteamParserFactory implements FactoryInterface
{
    public static function create(): SteamParser
    {
        return new SteamParser();
    }
}