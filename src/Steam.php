<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser;

use KrepyshSpec\SteamEnums\SteamApp;

class Steam
{
    public function __construct()
    {
        echo SteamApp::CSGO->value;
    }
}
