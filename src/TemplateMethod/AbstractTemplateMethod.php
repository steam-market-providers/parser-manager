<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\TemplateMethod;

use KrepyshSpec\SteamMarketParser\Builder\ParseRulesBuilder;
use KrepyshSpec\SteamMarketParser\Builder\SearchUrlBuilder;
use KrepyshSpec\SteamMarketParser\Contract\StrategyInterface;
use KrepyshSpec\SteamMarketParser\Http\Strategy\GuzzleStrategy;

abstract class AbstractTemplateMethod
{
    public function __construct(private null|StrategyInterface $strategy = null)
    {
        if (!$this->strategy) {
            $this->strategy = new GuzzleStrategy();
        }
    }

    final public function start(int $page)
    {
        $url = $this->createUrl($page);
        $parseRules = $this->createParseRules();

        $html = $this->strategy->sendRequest($url->build());

        print_r($html);


    }

    abstract protected function createUrl(int $page): SearchUrlBuilder;
    abstract protected function createParseRules(): ParseRulesBuilder;
}