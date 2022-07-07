<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager;

use SteamMarketProviders\ParserManager\TemplateMethod\AbstractTemplateMethod;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;

final class SteamParser
{
    private null|StrategyInterface $strategy;
    private null|AbstractTemplateMethod $templateMethod;

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

    /**
     * @param AbstractTemplateMethod $abstractTemplateMethod
     * @return $this
     */
    public function setTemplateMethod(AbstractTemplateMethod $abstractTemplateMethod): SteamParser
    {
        $this->templateMethod = new $abstractTemplateMethod($this->getStrategy());
        return $this;
    }

    /**
     * @return AbstractTemplateMethod|null
     */
    public function getTemplateMethod(): null|AbstractTemplateMethod
    {
        return $this->templateMethod;
    }

    /**
     * @param int $page
     * @return void
     */
    public function run(int $page = 1)
    {
        return $this->templateMethod->start($page);
    }
}
