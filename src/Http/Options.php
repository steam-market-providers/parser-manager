<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Http;

class Options
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
    public function setUserAgent(string $userAgent): Options
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
    public function setTimeout(int $timeout): Options
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
    public function setProxy(string $proxy): Options
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
     * @param Options $options
     * @return $this
     */
    public function setFromOptions(Options $options): Options
    {
        return $this->setUserAgent($options->getUserAgent())
            ->setTimeout($options->getTimeout())
            ->setProxy($options->getProxy());
    }
}
