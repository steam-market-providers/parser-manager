<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser;

use KrepyshSpec\SteamMarketParser\Enum\SteamCurrency;

class Steam
{
    public function __construct()
    {
        echo SteamCurrency::USD->value;
    }
}