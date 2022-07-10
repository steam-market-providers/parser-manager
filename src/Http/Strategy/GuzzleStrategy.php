<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Http\Strategy;

use GuzzleHttp\Client;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Http\Options;
use SteamMarketProviders\ParserManager\Http\Response;

class GuzzleStrategy implements StrategyInterface
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @param Options|null $options
     */
    public function __construct(private readonly null|Options $options = null)
    {
        $this->client = new Client();
    }

    public function sendRequest(string $url): Response
    {
       // $res = $this->client->get( $url, ['proxy' => "socks4://80.241.44.34:5678"]);
        $response = $this->client->get($url);

        return new Response(
            $response->getStatusCode(),
            $response->getHeaders(),
            json_decode($response->getBody()->getContents())
        );
    }
}
