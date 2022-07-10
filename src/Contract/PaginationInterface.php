<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Contract;

interface PaginationInterface
{
    /**
     * @param int $page
     * @param int $count
     * @return array
     */
    public function paginate(int $page = 1, int $count = 10): array;
}