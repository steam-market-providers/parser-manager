<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Parser\Provider;

use SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder;
use SteamMarketProviders\ParserManager\Builder\SearchUrlBuilder;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Http\Strategy\GuzzleStrategy;

abstract class AbstractProvider
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
        print_r(1);

        $html = $this->strategy->sendRequest($url->build());

        print_r($html);
    }

    abstract protected function createUrl(int $page): SearchUrlBuilder;
    abstract protected function createParseRules(): ParseRulesBuilder;
}