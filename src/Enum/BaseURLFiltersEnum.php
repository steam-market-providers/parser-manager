<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Enum;

enum BaseURLFiltersEnum: string
{
    case Search = "q";
    case Language = "l";
    case Pagination = "p@";
    case PaginationWithNameASC = "p@_name_asc";
    case PaginationWithNameDESC = "p@_name_desc";
    case PaginationWithPriceASC = "p@_price_asc";
    case PaginationWithPriceDESC = "p@_price_desc";
    case PaginationWithQuantityASC = "p@_quantity_asc";
    case PaginationWithQuantityDESC = "p@_quantity_desc";


}