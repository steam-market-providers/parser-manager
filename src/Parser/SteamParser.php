<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Parser;

use SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder;
use SteamMarketProviders\ParserManager\Contract\UrlBuilderInterface;
use SteamMarketProviders\ParserManager\Parser\Provider\AbstractProvider;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;

final class SteamParser
{
    private null|StrategyInterface $strategy = null;
    private ParseRulesBuilder $parseRulesBuilder;
    private UrlBuilderInterface $urlBuilder;

    public function __construct(private AbstractProvider $abstractProvider)
    {

    }

    /**
     * @param StrategyInterface $strategy
     * @return $this
     */
    public function setStrategy(StrategyInterface $strategy): SteamParser
    {
        $this->strategy = $strategy;
        return $this;
    }

    /**
     * @return StrategyInterface|null
     */
    public function getStrategy(): null|StrategyInterface
    {
        return $this->strategy;
    }

    /**
     * @return AbstractProvider|null
     */
    public function getProvider(): null|AbstractProvider
    {
        return $this->abstractProvider;
    }

    public function setParseRules(ParseRulesBuilder $parseRulesBuilder): SteamParser
    {
        $this->parseRulesBuilder = $parseRulesBuilder;
        return $this;
    }

    /**
     * @param int $page
     * @return void
     */
    public function run(int $page = 1)
    {
        return $this->abstractProvider->start($page);
    }
}
