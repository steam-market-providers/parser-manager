<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Parser;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Exceptions\ChildNotFoundException;
use PHPHtmlParser\Exceptions\CircularException;
use PHPHtmlParser\Exceptions\ContentLengthException;
use PHPHtmlParser\Exceptions\LogicalException;
use PHPHtmlParser\Exceptions\NotLoadedException;
use PHPHtmlParser\Exceptions\StrictException;
use stdClass;
use SteamMarketProviders\ParserManager\Builder\ParseRulesBuilder;
use SteamMarketProviders\ParserManager\Contract\StrategyInterface;
use SteamMarketProviders\ParserManager\Contract\UrlBuilderInterface;
use SteamMarketProviders\ParserManager\Exception\HttpException;
use SteamMarketProviders\ParserManager\Http\Http;

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
    private readonly Dom $dom;

    /**
     * @var Http
     */
    private readonly Http $http;

    public function __construct()
    {
        $this->http = new Http();
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

    /**
     * @param StrategyInterface $strategy
     * @return $this
     */
    public function setHttpStrategy(StrategyInterface $strategy): AbstractProvider
    {
        $this->http->setStrategy($strategy);

        return $this;
    }

    /**
     * @throws HttpException
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws StrictException
     * @throws NotLoadedException
     * @throws ContentLengthException
     * @throws LogicalException
     */
    final public function start(int $page): array
    {
        if (!$this->urlBuilder) {
            $this->urlBuilder = $this->createUrl($page);
        }

        if (!$this->parseRulesBuilder) {
            $this->parseRulesBuilder = $this->createParseRules();
        }

        $response = $this->http
            ->setUrl($this->urlBuilder->build())
            ->sendRequest();

        return $this->parseHtml($response);
    }

    /**
     * @param string $html
     * @return array
     * @throws ChildNotFoundException
     * @throws CircularException
     * @throws ContentLengthException
     * @throws LogicalException
     * @throws NotLoadedException
     * @throws StrictException
     */
    private function parseHtml(stdClass $html): array
    {
        $this->dom->loadStr($html->results_html);

        $contents = $this->dom->find('.market_listing_row_link');

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

        $this->parseSingleItem($data);

        return $data;
    }

    private function parseSingleItem(array &$data): void
    {
        foreach ($data as $name => $info) {
            $url = "https://steamcommunity.com/market/listings/730/" . urlencode($info['name']) . "/render?start=0&count=1&currency=1&format=json";
            $response = $this->http->setUrl($url)->sendRequest();
            $data['results_html'] = $response->results_html;
            $data['app_data'] = $response->app_data;
            $data['assets'] = $response->assets;
//            $response = $response->results_html;
//
//            $this->dom->loadStr($response);
//
//            $data[$name]['info'] = [];
//            $wrapper = $this->dom->find('.market_listing_iteminfo');
//
//            $data[$name]['info']['large_image'] = $wrapper->find('.market_listing_largeimage > img')->getAttribute('src');
        }
    }
}
