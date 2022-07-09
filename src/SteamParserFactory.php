<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager;

use SteamMarketProviders\ParserManager\Contract\FactoryInterface;
use SteamMarketProviders\ParserManager\Parser\Provider\AbstractProvider;
use SteamMarketProviders\ParserManager\Parser\SteamParser;

final class SteamParserFactory implements FactoryInterface
{
    /**
     * @param AbstractProvider $abstractProvider
     * @return SteamParser
     */
    public static function create(AbstractProvider $abstractProvider): SteamParser
    {
        return new SteamParser($abstractProvider);
    }
}
