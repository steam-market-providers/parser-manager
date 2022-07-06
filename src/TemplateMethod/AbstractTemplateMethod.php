<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\TemplateMethod;

use KrepyshSpec\SteamMarketParser\Interface\StrategyInterface;

abstract class AbstractTemplateMethod
{
    public function __construct(private StrategyInterface $strategy)
    {
    }

    final public function start(int $page)
    {
        $response = $this->strategy->sendRequest('https://steamcommunity.com/market/search?l=russian&appid=730');
        print_r($response);
        echo $this->prepareRequest();
    }

    abstract protected function prepareRequest();
}