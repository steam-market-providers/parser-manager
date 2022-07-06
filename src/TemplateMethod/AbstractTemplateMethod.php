<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\TemplateMethod;

use KrepyshSpec\SteamMarketParser\Builder\SearchUrlBuilder;
use KrepyshSpec\SteamMarketParser\Interface\StrategyInterface;

abstract class AbstractTemplateMethod
{
    public function __construct(readonly private StrategyInterface $strategy)
    {

    }

    final public function start(int $page)
    {
        $url = $this->createUrl($page);
        $parseRules = $this->createParseRules();

        $html = $this->strategy->sendRequest($url->build());


    }

    abstract protected function createUrl(int $page): SearchUrlBuilder;
    abstract protected function createParseRules();
}