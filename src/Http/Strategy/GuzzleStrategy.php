<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Http\Strategy;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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

    /**
     * @param string $url
     * @return Response
     * @throws GuzzleException
     */
    public function sendRequest(string $url): Response
    {
        $response = $this->client->get($url, [
            'proxy' => $this->options->toArray()
        ]);

        return new Response(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody()->getContents()
        );
    }
}
