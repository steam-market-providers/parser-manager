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

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->abstractProvider = new class extends AbstractProvider {

            /**
             * @param int $page
             * @return UrlBuilderInterface
             */
            protected function createUrl(int $page): UrlBuilderInterface
            {
                // TODO: Implement createUrl() method.
            }

            /**
             * @return ParseRulesBuilder
             */
            protected function createParseRules(): ParseRulesBuilder
            {
                // TODO: Implement createParseRules() method.
            }
        };
    }

    public function testSuccessCreating(): void
    {
         $result = SteamParserFactory::create($this->abstractProvider);
         $this->assertInstanceOf(SteamParser::class, $result);
    }
}