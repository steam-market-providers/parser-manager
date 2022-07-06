<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Builder;

use KrepyshSpec\SteamEnums\SteamLanguage;
use KrepyshSpec\SteamMarketParser\Enum\SteamConfigEnum;
use KrepyshSpec\SteamMarketParser\Enum\BaseURLFiltersEnum;
use KrepyshSpec\SteamMarketParser\Exception\BuilderNotSetParamException;
use KrepyshSpec\SteamMarketParser\Exception\InvalidArgumentException;
use KrepyshSpec\SteamMarketParser\Interface\UrlBuilderInterface;
use stdClass;

class SearchUrlBuilder implements UrlBuilderInterface
{
    protected stdClass $params;

    protected function reset(): void
    {
        $this->params = new stdClass();
    }

    /**
     * @param int $appId
     * @return UrlBuilderInterface
     */
    public function setAppId(int $appId): UrlBuilderInterface
    {
        $this->reset();
        $this->params->appId = $appId;

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
     * @throws BuilderNotSetParamException
     */
    public function setPage(int $page = 1): UrlBuilderInterface
    {
        $this->checkIfAppIdNotEmpty();
        $this->params->page = $page;

        return $this;
    }

    /**
     * @return string
     * @throws InvalidArgumentException
     */
    public function build(): string
    {
        $url = SteamConfigEnum::MarketSearchUrl->value;
        $url .= '/search?';

        $params = [];

        $params[BaseURLFiltersEnum::AppId->value] = $this->params->appId;

        if (isset($this->params->language)) {
            $params[BaseURLFiltersEnum::Language->value] = $this->params->language;
        }

        if(isset($this->params->page)) {
            $params[BaseURLFiltersEnum::Pagination->value] = BaseURLFiltersEnum::Pagination->setPage($this->params->page);
        }

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