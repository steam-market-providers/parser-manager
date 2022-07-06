<?php

use KrepyshSpec\SteamMarketParser\Strategy\CurlStrategy;
use KrepyshSpec\SteamMarketParser\SteamParserFactory;
use KrepyshSpec\SteamMarketParser\TemplateMethod\AbstractTemplateMethod;

require_once __DIR__  . '/../vendor/autoload.php';

class CsGO extends AbstractTemplateMethod implements \KrepyshSpec\SteamMarketParser\Interface\TemplateMethodInterface
{
    public function prepareRequest()
    {
       return "1";
    }
}

SteamParserFactory::create()
    ->setStrategy(new CurlStrategy())
    ->setTemplateMethod(CsGO::class)
    ->run();
