<?php

use JetBrains\PhpStorm\Pure;
use KrepyshSpec\SteamEnums\SteamApp;
use KrepyshSpec\SteamEnums\SteamLanguage;
use KrepyshSpec\SteamMarketParser\Builder\ParseRulesBuilder;
use KrepyshSpec\SteamMarketParser\Builder\SearchUrlBuilder;
use KrepyshSpec\SteamMarketParser\Http\HttpOptions;
use KrepyshSpec\SteamMarketParser\SteamParserFactory;
use KrepyshSpec\SteamMarketParser\Http\Strategy\GuzzleStrategy;
use KrepyshSpec\SteamMarketParser\TemplateMethod\AbstractTemplateMethod;

require_once __DIR__  . '/../vendor/autoload.php';

class CsGO extends AbstractTemplateMethod
{
    protected function createUrl(int $page): SearchUrlBuilder
    {
        return (new SearchUrlBuilder())
            ->setAppId(SteamApp::CSGO)
            ->setPage($page)
            ->setLanguage(SteamLanguage::Russian);
    }

    protected function createParseRules(): ParseRulesBuilder
    {
        return (new ParseRulesBuilder())
            ->wrapper('wrapper1', '.div', function(ParseRulesBuilder $builder) {
                $builder->item('image', '.sdas')
                    ->wrapper('wrapper2', '.lox', function(ParseRulesBuilder $builder) {
                        $builder->item('image2', '.sdas');
                    });
            });
    }
}

SteamParserFactory::create()
    ->setStrategy(new GuzzleStrategy(
        (new HttpOptions())
            ->setProxy('212.82.126.32:80')
            ->setUserAgent('Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1')
            ->setTimeout(10)
    ))
    ->setTemplateMethod(new CsGO())
    ->run();
