<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Http\Strategy;

use GuzzleHttp\Client;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Http\HttpOptions;

class GuzzleStrategy implements StrategyInterface
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @param HttpOptions|null $options
     */
    public function __construct(private readonly null|HttpOptions $options = null)
    {
        print_r($options);
        die();
        $this->client = new Client();
    }

    public function sendRequest(string $url): string
    {
        $res = $this->client->get($url);
        return $res->getBody()->getContents();
    }
}
