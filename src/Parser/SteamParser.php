<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Parser;

use PHPHtmlParser\Exceptions\ChildNotFoundException;
use PHPHtmlParser\Exceptions\CircularException;
use PHPHtmlParser\Exceptions\ContentLengthException;
use PHPHtmlParser\Exceptions\LogicalException;
use PHPHtmlParser\Exceptions\NotLoadedException;
use PHPHtmlParser\Exceptions\StrictException;
use SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder;
use SteamMarketProviders\ParserManager\Contract\UrlBuilderInterface;
use SteamMarketProviders\ParserManager\Exception\HttpException;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;

final class SteamParser
{
    /**
     * @param AbstractProvider $abstractProvider
     */
    public function __construct(readonly private AbstractProvider $abstractProvider)
    {
    }

    /**
     * @param StrategyInterface $strategy
     * @return $this
     */
    public function setHttpStrategy(StrategyInterface $strategy): SteamParser
    {
        $this->abstractProvider->setHttpStrategy($strategy);
        return $this;
    }

    /**
     * @param ParseRulesBuilder $parseRulesBuilder
     * @return $this
     */
    public function setParseRules(ParseRulesBuilder $parseRulesBuilder): SteamParser
    {
        $this->abstractProvider->setParseRules($parseRulesBuilder);

        return $this;
    }

    public function setUrl(UrlBuilderInterface $urlBuilder): SteamParser
    {
        $this->abstractProvider->setUrl($urlBuilder);

        return $this;
    }

    /**
     * @param int $page
     * @return array
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws ContentLengthException
     * @throws LogicalException
     * @throws NotLoadedException
     * @throws StrictException
     * @throws HttpException
     */
    public function run(int $page = 1): array
    {
        return $this->abstractProvider->start($page);
    }
}
