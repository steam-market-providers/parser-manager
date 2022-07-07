<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Parser\Provider;

use SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Contract\UrlBuilderInterface;
use SteamMarketProviders\ParserManager\Http\Strategy\GuzzleStrategy;

abstract class AbstractProvider
{
    private ParseRulesBuilder $parseRulesBuilder;
    private UrlBuilderInterface $urlBuilder;

    public function __construct(private null|StrategyInterface $strategy = null)
    {
        if (!$this->strategy) {
            $this->strategy = new GuzzleStrategy();
        }
    }

    public function setParseRules(ParseRulesBuilder $parseRulesBuilder)
    {
        $this->parseRulesBuilder = $parseRulesBuilder;
    }

    final public function start(int $page)
    {
        $url = $this->createUrl($page);
        $parseRules = $this->createParseRules();

        $html = $this->strategy->sendRequest($url->build());

        print_r($html);
    }

    abstract protected function createUrl(int $page): UrlBuilderInterface;
    abstract protected function createParseRules(): ParseRulesBuilder;
}
