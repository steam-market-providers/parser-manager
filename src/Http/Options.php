<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Http;

class Options
{
    /**
     * @var float
     */
    private float $timeout = 6.00;

    /**
     * @var float
     */
    private float $connectTimeout = 6.00;

    /**
     * @var string|null
     */
    private null|string $proxy;

    /**
     * @param float $timeout
     * @return $this
     */
    public function setTimeout(float $timeout): Options
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return float
     */
    public function getTimeout(): float
    {
        return $this->timeout;
    }

    /**
     * @param $connectTimeout
     * @return $this
     */
    public function setConnectTimeout($connectTimeout): Options
    {
        $this->connectTimeout = $connectTimeout;

        return $this;
    }

    /**
     * @return float
     */
    public function getConnectTimeout(): float
    {
        return $this->connectTimeout;
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
        return $this->setTimeout($options->getTimeout())
            ->setConnectTimeout($options->getConnectTimeout())
            ->setProxy($options->getProxy());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $options = [];

        if ($this->getTimeout()) {
            $options['timeout'] = $this->getTimeout();
        }

        if ($this->getConnectTimeout()) {
            $options['connect_timeout'] = $this->getConnectTimeout();
        }

        if ($this->getProxy()) {
            $options['proxy'] = $this->getProxy();
        }

        return $options;
    }
}
