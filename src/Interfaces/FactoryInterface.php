<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Interfaces;

use KrepyshSpec\SteamMarketParser\SteamParser;

interface FactoryInterface
{
    public static function create(): SteamParser;
}