<?php

declare(strict_types=1);

namespace SteamMarketProviders\ParserManager\Builder;

use stdClass;

class ListingUrlBuilder
{
    protected stdClass $params;

    protected function reset(): void
    {
        $this->params = new stdClass();
    }
}