<?php

namespace SteamMarketProviders\ParserManager\Builder;

use Closure;

class ParseRulesBuilder
{
    private \stdClass $rules;

    public function __construct()
    {
        $this->rules = new \stdClass();
    }

    public function wrapper(string $name, string $value, Closure $wrapper)
    {
        $old = clone $this->rules;

        $this->rules->$name = $value;
        call_user_func($wrapper, $this);

        return $this;
    }

    public function item(string $name, string $value)
    {
        $this->rules->$name = $value;
        return $this;
    }

    public function print()
    {
        var_dump($this->rules);
    }
}
