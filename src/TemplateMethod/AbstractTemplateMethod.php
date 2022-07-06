<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\TemplateMethod;

use KrepyshSpec\SteamEnums\SteamLanguage;
use KrepyshSpec\SteamMarketParser\Builder\SearchUrlBuilder;
use KrepyshSpec\SteamMarketParser\Interface\StrategyInterface;

abstract class AbstractTemplateMethod
{
    public function __construct(private StrategyInterface $strategy)
    {

    }

    final public function start(int $page)
    {
        $url =  (new SearchUrlBuilder())
            ->setAppId($this->getAppId())
            ->setPage($page)
            ->setLanguage(SteamLanguage::Russian)
            ->build();

        echo $url . PHP_EOL;die();

        $response = $this->strategy->sendRequest($url);
        print_r($response);
        echo $this->prepareRequest();
    }

    abstract protected function getAppId(): int;
    abstract protected function prepareRequest();
}