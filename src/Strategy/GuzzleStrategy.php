<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Strategy;

use GuzzleHttp\Client;
use KrepyshSpec\SteamMarketParser\Interface\StrategyInterface;

class GuzzleStrategy implements StrategyInterface
{
    private Client $client;
    public function __construct()
    {
        $this->client = new Client();
    }

    public function sendRequest(string $url): string
    {
        $res = $this->client->get($url);
        return $res->getBody()->getContents();
    }

}