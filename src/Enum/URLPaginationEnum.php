<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Enum;

use SteamMarketProviders\ParserManager\Contract\PaginationInterface;
use SteamMarketProviders\ParserManager\Exception\InvalidArgumentException;

enum URLPaginationEnum: string implements PaginationInterface
{
    case Start = 'start';
    case Count = 'count';

    /**
     * @param int $page
     * @param int $count
     * @return int
     * @throws InvalidArgumentException
     */
    public function calculate(int $page = 1, int $count = 10): int
    {
        return match ($this) {
            self::Start => $page * $count,
            default => throw new InvalidArgumentException('Unexpected match value'),
        };
    }
}
