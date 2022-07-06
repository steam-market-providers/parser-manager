<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser;

use KrepyshSpec\SteamMarketParser\TemplateMethod\AbstractTemplateMethod;
use KrepyshSpec\SteamMarketParser\Interface\StrategyInterface;

final class SteamParser
{
    private StrategyInterface $strategy;
    private null|AbstractTemplateMethod $templateMethod;

    public function setStrategy(StrategyInterface $strategy): SteamParser
    {
        $this->strategy = $strategy;
        return $this;
    }

    public function getStrategy(): StrategyInterface
    {
        return $this->strategy;
    }

    public function setTemplateMethod(string $templateMethod): SteamParser
    {
        $this->templateMethod = new $templateMethod($this->getStrategy());
        return $this;
    }

    public function getTemplateMethod(): null|AbstractTemplateMethod
    {
        return $this->templateMethod;
    }

    public function run(int $page = 1)
    {
        return $this->templateMethod->start($page);
    }
}
