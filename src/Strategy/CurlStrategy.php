<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Strategy;

use CurlHandle;
use KrepyshSpec\SteamMarketParser\Interface\StrategyInterface;

class CurlStrategy implements StrategyInterface
{
    /**
     * @var false|CurlHandle
     */
    private false|CurlHandle $ch;

    public function __construct()
    {
        $this->ch = curl_init();
        $this->setCurlOptions();
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }

    /**
     * @param string $url
     * @return bool|string
     */
    public function sendRequest(string $url): string
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        return curl_exec($this->ch);
    }

    /**
     * @return void
     */
    private function setCurlOptions(): void
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
        );

        curl_setopt_array($this->ch, $options);
    }
}