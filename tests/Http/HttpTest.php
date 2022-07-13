<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Tests\Http;

use PHPUnit\Framework\TestCase;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Exception\InvalidArgumentException;
use SteamMarketProviders\ParserManager\Http\Http;
use SteamMarketProviders\ParserManager\Http\Options;
use SteamMarketProviders\ParserManager\Http\Response;
use SteamMarketProviders\ParserManager\Http\Strategy\GuzzleStrategy;

class HttpTest extends TestCase
{
    private readonly Http $http;
    private StrategyInterface $strategy;

    public function setUp(): void
    {
        $this->http = new Http();

        $this->strategy = new class () implements StrategyInterface {
            public function __construct(?Options $options = null)
            {
            }

            public function sendRequest(string $url): Response
            {
            }
        };
    }

    public function testSetUrl(): void
    {
        $result = $this->http->setUrl("https://steamcommunity.com/market/listings/730/AWP%20%7C%20Phobos%20%28Field-Tested%29/render?start=0&count=1&currency=1&format=json");
        $this->assertInstanceOf(Http::class, $result);
    }

    public function testFailureSetUrl(): void
    {
        $url = "https://steamcommunity.com/market/listings/730/Awp Dragon lord/render?start=0&count=1&currency=1&format=json";

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The url: "https://steamcommunity.com/market/listings/730/Awp Dragon lord/render?start=0&count=1&currency=1&format=json" is not in a valid format');

        $this->http->setUrl($url);
    }

    public function testDefaultStrategy(): void
    {
        $this->assertInstanceOf(GuzzleStrategy::class, $this->http->getStrategy());
    }

    public function testSetStrategy(): void
    {
        $this->http->setStrategy($this->strategy);

        $this->assertInstanceOf(StrategyInterface::class, $this->http->getStrategy());
    }

    public function testSendRequestWhenUrlIsNotSet(): void
    {
        $this->expectExceptionMessage('Typed property SteamMarketProviders\ParserManager\Http\Http::$url must not be accessed before initialization');
        $this->http->sendRequest();
    }
}
