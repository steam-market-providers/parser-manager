<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Enum;

enum URLFiltersEnum: string
{
    case AppId    = 'appid';
    case Search   = "q";
    case Language = "l";
    case Currency = 'currency';
}
