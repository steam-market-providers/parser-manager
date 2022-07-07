<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Contract;

use KrepyshSpec\SteamEnums\SteamApp;
use KrepyshSpec\SteamEnums\SteamLanguage;

interface UrlBuilderInterface
{
    public function setAppId(SteamApp $steamApp): UrlBuilderInterface;

    public function setLanguage(SteamLanguage $steamLanguage = SteamLanguage::English): UrlBuilderInterface;

    public function setPage(int $page): UrlBuilderInterface;

    public function build(): string;
}