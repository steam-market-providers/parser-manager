<?php

use JetBrains\PhpStorm\Pure;
use KrepyshSpec\SteamEnums\SteamApp;
use KrepyshSpec\SteamEnums\SteamLanguage;
use KrepyshSpec\SteamMarketParser\Builder\SearchUrlBuilder;
use KrepyshSpec\SteamMarketParser\Interface\TemplateMethodInterface;
use KrepyshSpec\SteamMarketParser\Strategy\CurlStrategy;
use KrepyshSpec\SteamMarketParser\SteamParserFactory;
use KrepyshSpec\SteamMarketParser\Strategy\GuzzleStrategy;
use KrepyshSpec\SteamMarketParser\TemplateMethod\AbstractTemplateMethod;

require_once __DIR__  . '/../vendor/autoload.php';

class CsGO extends AbstractTemplateMethod implements TemplateMethodInterface
{
    public function createUrl(int $page): SearchUrlBuilder
    {
        return (new SearchUrlBuilder())
            ->setAppId(SteamApp::CSGO->value)
            ->setPage($page)
            ->setLanguage(SteamLanguage::Russian);
    }

    public function createParseRules()
    {

    }

    public function prepareRequest()
    {
       return "1";
    }
}

SteamParserFactory::create()
    ->setStrategy(new CurlStrategy())
    ->setTemplateMethod(CsGO::class)
    ->run();
