<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Enum;

enum SteamConfigEnum: string
{
    case MarketSearchUrl = "https://steamcommunity.com/market/search/render";
    case MarketListingUrl = "https://steamcommunity.com/market/listings";
}
