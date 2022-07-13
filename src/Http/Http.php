<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Http;

use Exception;
use stdClass;
use SteamMarketProviders\ParserManager\Contract\Http\HttpExceptionInterface;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Exception\Http\URLNotSetException;
use SteamMarketProviders\ParserManager\Exception\HttpException;
use SteamMarketProviders\ParserManager\Exception\InvalidArgumentException;
use SteamMarketProviders\ParserManager\Http\Strategy\GuzzleStrategy;

final class Http
{
    private string $url;

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
     * @param string $url
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setUrl(string $url): Http
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(
                sprintf('The url: "%s" is not in a valid format', $url)
            );
        }

        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
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

    /**
     * @return StrategyInterface
     */
    public function getStrategy(): StrategyInterface
    {
        return $this->strategy;
    }

    /**
     * @return stdClass
     * @throws HttpException
     * @throws HttpExceptionInterface
     * @throws URLNotSetException
     */
    public function sendRequest(): stdClass
    {
        try {
            $response = $this->strategy->sendRequest($this->url);

            $code = $response->getStatus();
            if ($code !== 200) {
                throw new HttpException("");
            }

            $response = json_decode($response->getBody());

            if (!$response->success) {
                throw new HttpException("");
            }
        } catch (HttpExceptionInterface $httpException) {
            throw new $httpException();
        } catch (Exception $e) {
            throw new HttpException($e->getMessage());
        }

        return $response;
    }
}
