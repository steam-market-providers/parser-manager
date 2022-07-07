<?php

use JetBrains\PhpStorm\Pure;
use KrepyshSpec\SteamEnums\SteamApp;
use KrepyshSpec\SteamEnums\SteamLanguage;
use SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder;
use SteamMarketProviders\ParserManager\Builder\SearchUrlBuilder;
use SteamMarketProviders\ParserManager\Http\HttpOptions;
use SteamMarketProviders\ParserManager\Parser\Provider\AbstractProvider;
use SteamMarketProviders\ParserManager\SteamParserFactory;
use SteamMarketProviders\ParserManager\Http\Strategy\GuzzleStrategy;

require_once __DIR__  . '/../vendor/autoload.php';

class CsGOProvider extends AbstractProvider
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
    ->setProvider(abstractProvider: new CsGOProvider())
    ->run();
