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
     * @return string[]
     * @throws InvalidArgumentException
     */
    public function paginate(int $page = 1, int $count = 10): array
    {
        return match ($this) {
            self::Start => [self::Start->value => $page * $count, self::Count->value => $count],
            default => throw new InvalidArgumentException('Unexpected match value'),
        };
    }
}