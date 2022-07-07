<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Contract;

use SteamMarketProviders\ParserManager\Parser\Provider\AbstractProvider;
use SteamMarketProviders\ParserManager\Parser\SteamParser;

interface FactoryInterface
{
    public static function create(AbstractProvider $abstractProvider): SteamParser;
}
