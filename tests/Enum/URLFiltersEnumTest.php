<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Tests\Enum;

use PHPUnit\Framework\TestCase;
use SteamMarketProviders\ParserManager\Enum\URLPaginationEnum;
use SteamMarketProviders\ParserManager\Exception\InvalidArgumentException;

class URLFiltersEnumTest extends TestCase
{
    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testCalculateMethod(): void
    {
        $result = URLPaginationEnum::Start->calculate();
        $this->assertEquals($result, 10);
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function testFailureCalculateMethod(): void
    {
        $this->expectException(InvalidArgumentException::class);
        URLPaginationEnum::Count->calculate(1, 10);
    }
}