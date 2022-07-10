<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Parser\Provider;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Exceptions\ChildNotFoundException;
use PHPHtmlParser\Exceptions\CircularException;
use PHPHtmlParser\Exceptions\ContentLengthException;
use PHPHtmlParser\Exceptions\LogicalException;
use PHPHtmlParser\Exceptions\NotLoadedException;
use PHPHtmlParser\Exceptions\StrictException;
use SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Contract\UrlBuilderInterface;
use SteamMarketProviders\ParserManager\Http\Strategy\GuzzleStrategy;

abstract class AbstractProvider
{
    /**
     * @var ParseRulesBuilder|null
     */
    private null|ParseRulesBuilder $parseRulesBuilder = null;

    /**
     * @var UrlBuilderInterface|null
     */
    private null|UrlBuilderInterface $urlBuilder = null;

    /**
     * @var Dom
     */
    private Dom $dom;

    /**
     * @param StrategyInterface|null $strategy
     */
    public function __construct(private null|StrategyInterface $strategy = null)
    {
        if (!$this->strategy) {
            $this->strategy = new GuzzleStrategy();
        }

        $this->dom = new Dom();
    }

    /**
     * @param int $page
     * @return UrlBuilderInterface
     */
    abstract protected function createUrl(int $page): UrlBuilderInterface;

    /**
     * @return ParseRulesBuilder
     */
    abstract protected function createParseRules(): ParseRulesBuilder;

    /**
     * @param UrlBuilderInterface $urlBuilder
     * @return void
     */
    public function setUrl(UrlBuilderInterface $urlBuilder): void
    {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param ParseRulesBuilder $parseRulesBuilder
     * @return void
     */
    public function setParseRules(ParseRulesBuilder $parseRulesBuilder): void
    {
        $this->parseRulesBuilder = $parseRulesBuilder;
    }

    final public function start(int $page): array
    {
        if (!$this->urlBuilder) {
            $this->urlBuilder = $this->createUrl($page);
        }

        if (!$this->parseRulesBuilder) {
            $this->parseRulesBuilder = $this->createParseRules();
        }

        return $this->doParseRequest();

    }

    /**
     * @throws ChildNotFoundException
     * @throws NotLoadedException
     * @throws ContentLengthException
     * @throws CircularException
     * @throws LogicalException
     * @throws StrictException
     */
    private function doParseRequest(): array
    {
        $html = $this->strategy->sendRequest($this->urlBuilder->build());

        $this->dom->loadStr($html);

        $contents = $this->dom->find('#searchResultsRows .market_listing_row_link');

        $data = [];

        foreach ($contents as $row) {
            $link = $row->getAttribute('href');
            $name = $row->find('.market_listing_item_name_block > span');
            $prices = $row->find('.market_listing_their_price .normal_price span');

            $data[] = [
                'link'=> $link,
                'name' => $name->innerHtml,
                'price' => $prices->innerHtml
            ];
        }

        return $data;
    }
}
