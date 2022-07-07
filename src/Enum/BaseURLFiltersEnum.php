<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Enum;

use SteamMarketProviders\ParserManager\Exception\InvalidArgumentException;

enum BaseURLFiltersEnum: string
{
    case AppId  = 'appid';
    case Search = "q";
    case Language = "l";

    case Pagination = "p";
    case PaginationWithNameASC = "name_asc";
    case PaginationWithNameDESC = "name_desc";
    case PaginationWithPriceASC = "price_asc";
    case PaginationWithPriceDESC = "price_desc";
    case PaginationWithQuantityASC = "quantity_asc";
    case PaginationWithQuantityDESC = "quantity_desc";

    /**
     * @param int $page
     * @return string
     * @throws InvalidArgumentException
     */
    public function setPage(int $page = 1): string
    {
        return match($this)
        {
            self::Pagination => self::Pagination->value . $page,
            default => throw new InvalidArgumentException('Unexpected match value'),
        };
    }

}