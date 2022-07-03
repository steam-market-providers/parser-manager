<?php

use KrepyshSpec\SteamMarketParser\Strategy\GuzzleStrategy;
use KrepyshSpec\SteamMarketParser\SteamParserFactory;

require_once __DIR__  . '/../vendor/autoload.php';

$steamParser = SteamParserFactory::create();
$steamParser->setStrategy(new GuzzleStrategy());
