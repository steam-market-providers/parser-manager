<?php

declare(strict_types=1);

namespace KrepyshSpec\SteamMarketParser\Builder;

use stdClass;

class ListingUrlBuilder
{
    protected stdClass $params;

    protected function reset(): void
    {
        $this->params = new stdClass();
    }
}