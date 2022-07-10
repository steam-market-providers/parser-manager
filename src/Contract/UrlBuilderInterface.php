<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Contract;

use SteamMarketProviders\Enums\SteamApp;
use SteamMarketProviders\Enums\SteamCurrency;
use SteamMarketProviders\Enums\SteamLanguage;

interface UrlBuilderInterface
{
    /**
     * @param SteamApp $steamApp
     * @return UrlBuilderInterface
     */
    public function setAppId(SteamApp $steamApp): UrlBuilderInterface;

    /**
     * @param SteamLanguage $steamLanguage
     * @return UrlBuilderInterface
     */
    public function setLanguage(SteamLanguage $steamLanguage = SteamLanguage::English): UrlBuilderInterface;

    /**
     * @param SteamCurrency $steamCurrency
     * @return UrlBuilderInterface
     */
    public function setCurrency(SteamCurrency $steamCurrency = SteamCurrency::USD): UrlBuilderInterface;

    /**
     * @param int $page
     * @return UrlBuilderInterface
     */
    public function setPage(int $page): UrlBuilderInterface;

    /**
     * @return string
     */
    public function build(): string;
}
