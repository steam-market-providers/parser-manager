<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Tests\Parser;

use Exception;
use PHPHtmlParser\Exceptions\ChildNotFoundException;
use PHPHtmlParser\Exceptions\CircularException;
use PHPHtmlParser\Exceptions\ContentLengthException;
use PHPHtmlParser\Exceptions\LogicalException;
use PHPHtmlParser\Exceptions\NotLoadedException;
use PHPHtmlParser\Exceptions\StrictException;
use PHPUnit\Framework\TestCase;
use SteamMarketProviders\Enums\SteamApp;
use SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder;
use SteamMarketProviders\ParserManager\Builder\SearchUrlBuilder;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Contract\UrlBuilderInterface;
use SteamMarketProviders\ParserManager\Exception\HttpException;
use SteamMarketProviders\ParserManager\Http\Options;
use SteamMarketProviders\ParserManager\Http\Response;
use SteamMarketProviders\ParserManager\Parser\AbstractProvider;
use SteamMarketProviders\ParserManager\SteamParserFactory;

class SteamParserTest extends TestCase
{
    public function testWhenProviderMethodCreateUrlNoneReturned(): void
    {
        $this->expectExceptionMessage('SteamMarketProviders\ParserManager\Parser\AbstractProvider@anonymous::createUrl(): Return value must be of type SteamMarketProviders\ParserManager\Contract\UrlBuilderInterface, none returned');

        $provider = new class () extends AbstractProvider {
            protected function createUrl(int $page): UrlBuilderInterface
            {
            }
            protected function createParseRules(): ParseRulesBuilder
            {
            }
        };

        SteamParserFactory::create($provider)->run();
    }

    public function testWhenProviderMethodCreateParseRulesNoneReturned(): void
    {
        $this->expectExceptionMessage('SteamMarketProviders\ParserManager\Parser\AbstractProvider@anonymous::createParseRules(): Return value must be of type SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder, none returned');

        $provider = new class () extends AbstractProvider {
            protected function createUrl(int $page): UrlBuilderInterface
            {
                return (new SearchUrlBuilder())
                    ->setAppId(SteamApp::CSGO)
                    ->setPage($page);
            }
            protected function createParseRules(): ParseRulesBuilder
            {
            }
        };

        SteamParserFactory::create($provider)->run();
    }
}
