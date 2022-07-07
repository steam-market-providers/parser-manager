<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Parser;

use SteamMarketProviders\ParserManager\TemplateMethod\AbstractProvider;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;

final class SteamParser
{
    private null|StrategyInterface $strategy;
    private null|AbstractProvider $abstractProvider;

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
     * @return StrategyInterface
     */
    public function getStrategy(): StrategyInterface
    {
        return $this->strategy;
    }
    
    public function setProvider(AbstractProvider $abstractProvider): SteamParser
    {
        $this->abstractProvider = new $abstractProvider($this->getStrategy());
        return $this;
    }

    /**
     * @return AbstractProvider|null
     */
    public function getProvider(): null|AbstractProvider
    {
        return $this->abstractProvider;
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
