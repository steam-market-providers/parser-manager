<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Tests;

use PHPUnit\Framework\TestCase;
use SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder;
use SteamMarketProviders\ParserManager\Contract\UrlBuilderInterface;
use SteamMarketProviders\ParserManager\Parser\AbstractProvider;
use SteamMarketProviders\ParserManager\Parser\SteamParser;
use SteamMarketProviders\ParserManager\SteamParserFactory;

class SteamParserFactoryTest extends TestCase
{
    private AbstractProvider $abstractProvider;

    public function setUp(): void
    {
        $this->abstractProvider = new class () extends AbstractProvider {
            protected function createUrl(int $page): UrlBuilderInterface
            {
            }

            /**
             * @return ParseRulesBuilder
             */
            protected function createParseRules(): ParseRulesBuilder
            {
            }
        };
    }

    public function testSuccessCreating(): void
    {
        $result = SteamParserFactory::create($this->abstractProvider);
        $this->assertInstanceOf(SteamParser::class, $result);
    }
}
