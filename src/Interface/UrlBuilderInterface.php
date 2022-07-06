<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Interface;

use KrepyshSpec\SteamEnums\SteamLanguage;

interface UrlBuilderInterface
{
    public function setAppId(int $appId): UrlBuilderInterface;

    public function setLanguage(SteamLanguage $steamLanguage = SteamLanguage::English): UrlBuilderInterface;

    public function setPage(int $page): UrlBuilderInterface;

    public function build(): string;
}