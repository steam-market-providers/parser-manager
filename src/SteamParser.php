<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser;

use KrepyshSpec\SteamMarketParser\Interfaces\StrategyInterface;

class SteamParser
{
    private StrategyInterface $strategy;

    public function __construct()
    {
    }

    public function setStrategy(StrategyInterface $strategy): SteamParser
    {
        $this->strategy = $strategy;
        return $this;
    }
}
