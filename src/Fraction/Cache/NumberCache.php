<?php

namespace Saki\Fraction\Cache;

use BcMath\Number;
use LogicException;

class NumberCache
{
    public ?Number $value = null;

    public function get(): ?Number
    {
        return $this->value;
    }

    public function set(Number $value): void
    {
        if (!is_null($this->value)) {
            // @codeCoverageIgnoreStart
            throw new LogicException('Value is already set');
            // @codeCoverageIgnoreEnd
        }
        $this->value = $value;
    }
}