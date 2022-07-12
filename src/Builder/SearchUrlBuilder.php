<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Builder;

use SteamMarketProviders\Enums\SteamApp;
use SteamMarketProviders\Enums\SteamCurrency;
use SteamMarketProviders\Enums\SteamLanguage;
use SteamMarketProviders\ParserManager\Enum\SteamConfigEnum;
use SteamMarketProviders\ParserManager\Enum\URLFiltersEnum;
use SteamMarketProviders\ParserManager\Enum\URLPaginationEnum;
use SteamMarketProviders\ParserManager\Exception\BuilderNotSetParamException;
use SteamMarketProviders\ParserManager\Exception\InvalidArgumentException;
use SteamMarketProviders\ParserManager\Contract\UrlBuilderInterface;
use stdClass;

class SearchUrlBuilder implements UrlBuilderInterface
{
    /**
     * @var stdClass
     */
    protected stdClass $params;

    /**
     * @return void
     */
    protected function reset(): void
    {
        $this->params = new stdClass();
    }

    /**
     * @param SteamApp $steamApp
     * @return UrlBuilderInterface
     */
    public function setAppId(SteamApp $steamApp): UrlBuilderInterface
    {
        $this->reset();
        $this->params->appId = $steamApp->value;

        return $this;
    }

    /**
     * @throws BuilderNotSetParamException
     */
    public function setLanguage(SteamLanguage $steamLanguage = SteamLanguage::English): UrlBuilderInterface
    {
        $this->checkIfAppIdNotEmpty();
        $this->params->language = $steamLanguage->value;

        return $this;
    }

    /**
     * @param SteamCurrency $steamCurrency
     * @return UrlBuilderInterface
     * @throws BuilderNotSetParamException
     */
    public function setCurrency(SteamCurrency $steamCurrency = SteamCurrency::USD): UrlBuilderInterface
    {
        $this->checkIfAppIdNotEmpty();
        $this->params->currency = $steamCurrency->value;

        return $this;
    }

    /**
     * @throws BuilderNotSetParamException
     */
    public function setPage(int $page = 1): UrlBuilderInterface
    {
        $this->checkIfAppIdNotEmpty();
        $this->params->page = $page;

        return $this;
    }

    /**
     * @param int $count
     * @return UrlBuilderInterface
     * @throws BuilderNotSetParamException
     */
    public function setCount(int $count = 10): UrlBuilderInterface
    {
        $this->checkIfAppIdNotEmpty();
        $this->params->count = $count;

        return $this;
    }

    /**
     * @return string
     * @throws InvalidArgumentException
     */
    public function build(): string
    {
        $url = SteamConfigEnum::MarketSearchUrl->value;

        $params = [];

        $params[URLFiltersEnum::AppId->value] = $this->params->appId;

        if (isset($this->params->language)) {
            $params[URLFiltersEnum::Language->value] = $this->params->language;
        }

        if (isset($this->params->currency)) {
            $params[URLFiltersEnum::Currency->value] = $this->params->currency;
        }

        if (isset($this->params->page) && isset($this->params->count)) {
            $params[URLPaginationEnum::Start->value] = URLPaginationEnum::Start->calculate($this->params->page, $this->params->count);
            $params[URLPaginationEnum::Count->value] = $this->params->count;
        }

        $url .= '?';
        $url .= http_build_query($params);

        return $url;
    }

    /**
     * @return void
     * @throws BuilderNotSetParamException
     */
    private function checkIfAppIdNotEmpty(): void
    {
        if (!isset($this->params->appId)) {
            throw new BuilderNotSetParamException("AppId cannot be empty");
        }
    }
}
