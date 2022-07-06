<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Enum;

enum SteamConfigEnum: string
{
    case MarketSearchUrl = "https://steamcommunity.com/market/search";
    case MarketListingUrl = "https://steamcommunity.com/market/listings";
}