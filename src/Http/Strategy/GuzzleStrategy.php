<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Http\Strategy;

use GuzzleHttp\Client;
use KrepyshSpec\SteamMarketParser\Contract\StrategyInterface;
use KrepyshSpec\SteamMarketParser\Http\HttpOptions;

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
        print_r($options);die();
        $this->client = new Client();
    }

    public function sendRequest(string $url): string
    {
        $res = $this->client->get($url);
        return $res->getBody()->getContents();
    }

}