<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Interface;

interface StrategyInterface
{
    public function sendRequest(string $url): string;
}