<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Http;

use stdClass;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Exception\HttpException;
use SteamMarketProviders\ParserManager\Http\Strategy\GuzzleStrategy;
use Throwable;

final class Http
{
    /**
     * @param StrategyInterface|null $strategy
     */
    public function __construct(private null|StrategyInterface $strategy = null)
    {
        if (!$this->strategy) {
            $this->strategy = new GuzzleStrategy();
        }
    }

    /**
     * @param StrategyInterface $strategy
     * @return $this
     */
    public function setStrategy(StrategyInterface $strategy): Http
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function sendRequest(string $url): stdClass
    {
        return $this->handlerRequest($url);
    }

    private function handlerRequest(string $url): stdClass
    {
        try {
            $response = $this->strategy->sendRequest($url);

            $code = $response->getStatus();
            if ($code !== 200) {
                throw new HttpException("");
            }

            $response = json_decode($response->getBody());

            if (!$response->success) {
                throw new HttpException("");
            }
        } catch (Throwable $throwable) {
            throw new HttpException($throwable->getMessage());
        }

        return $response;
    }
}
