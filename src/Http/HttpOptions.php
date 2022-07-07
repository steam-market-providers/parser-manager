<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Http;

class HttpOptions
{
    /**
     * @var string|null
     */
    private null|string $userAgent;

    /**
     * @var int
     */
    private int $timeout;

    /**
     * @var string|null
     */
    private null|string $proxy;

    /**
     * @param string $userAgent
     * @return $this
     */
    public function setUserAgent(string $userAgent): HttpOptions
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserAgent(): null|string
    {
        return $this->userAgent;
    }

    /**
     * @param int $timeout
     * @return $this
     */
    public function setTimeout(int $timeout): HttpOptions
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param string $proxy
     * @return $this
     */
    public function setProxy(string $proxy): HttpOptions
    {
        $this->proxy = $proxy;

        return $this;
    }

    /**
     * @return string
     */
    public function getProxy(): string
    {
        return $this->proxy;
    }


    /**
     * @param HttpOptions $options
     * @return $this
     */
    public function setFromOptions(HttpOptions $options): HttpOptions
    {
        return $this->setUserAgent($options->getUserAgent())
            ->setTimeout($options->getTimeout())
            ->setProxy($options->getProxy());
    }
}
