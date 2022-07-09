<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Contract;

use SteamMarketProviders\Enums\SteamApp;
use SteamMarketProviders\Enums\SteamLanguage;

interface UrlBuilderInterface
{
    public function setAppId(SteamApp $steamApp): UrlBuilderInterface;

    public function setLanguage(SteamLanguage $steamLanguage = SteamLanguage::English): UrlBuilderInterface;

    public function setPage(int $page): UrlBuilderInterface;

    public function build(): string;
}
