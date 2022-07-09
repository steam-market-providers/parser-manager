<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Parser\Provider;

use SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Contract\UrlBuilderInterface;
use SteamMarketProviders\ParserManager\Http\Strategy\GuzzleStrategy;

abstract class AbstractProvider
{
    /**
     * @var ParseRulesBuilder|null
     */
    private null|ParseRulesBuilder $parseRulesBuilder = null;

    /**
     * @var UrlBuilderInterface|null
     */
    private null|UrlBuilderInterface $urlBuilder = null;

    /**
     * @param StrategyInterface|null $strategy
     */
    public function __construct(private null|StrategyInterface $strategy = null)
    {
        if (!$this->strategy) {
            $this->strategy = new GuzzleStrategy();
        }
    }

    /**
     * @param int $page
     * @return UrlBuilderInterface
     */
    abstract protected function createUrl(int $page): UrlBuilderInterface;

    /**
     * @return ParseRulesBuilder
     */
    abstract protected function createParseRules(): ParseRulesBuilder;

    /**
     * @param UrlBuilderInterface $urlBuilder
     * @return void
     */
    public function setUrl(UrlBuilderInterface $urlBuilder): void
    {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param ParseRulesBuilder $parseRulesBuilder
     * @return void
     */
    public function setParseRules(ParseRulesBuilder $parseRulesBuilder): void
    {
        $this->parseRulesBuilder = $parseRulesBuilder;
    }

    final public function start(int $page)
    {
        if (!$this->urlBuilder) {
            $this->urlBuilder = $this->createUrl($page);
        }

        if (!$this->parseRulesBuilder) {
            $this->parseRulesBuilder = $this->createParseRules();
        }

        $html = $this->strategy->sendRequest($this->urlBuilder->build());

        print_r($html);
    }
}
