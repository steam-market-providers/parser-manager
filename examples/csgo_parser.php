<?php

use JetBrains\PhpStorm\Pure;
use KrepyshSpec\SteamEnums\SteamApp;
use KrepyshSpec\SteamMarketParser\Interface\TemplateMethodInterface;
use KrepyshSpec\SteamMarketParser\Strategy\CurlStrategy;
use KrepyshSpec\SteamMarketParser\SteamParserFactory;
use KrepyshSpec\SteamMarketParser\TemplateMethod\AbstractTemplateMethod;

require_once __DIR__  . '/../vendor/autoload.php';

class CsGO extends AbstractTemplateMethod implements TemplateMethodInterface
{
    public function getAppId(): int
    {
        return SteamApp::CSGO->value;
    }

    public function prepareRequest()
    {
       return "1";
    }
}

SteamParserFactory::create()
    ->setStrategy(new CurlStrategy())
    ->setTemplateMethod(CsGO::class)
    ->run();
