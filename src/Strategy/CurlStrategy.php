<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Strategy;

use CurlHandle;
use KrepyshSpec\SteamMarketParser\Interface\StrategyInterface;

class CurlStrategy implements StrategyInterface
{
    private false|CurlHandle $ch;

    public function __construct()
    {
        $this->ch = curl_init();
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }

    /**
     * @param string $url
     * @return bool|string
     */
    public function sendRequest(string $url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $content = curl_exec($this->ch);
        return $content;
    }
}