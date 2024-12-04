<?php

namespace Saki\Fraction\Cache;

use LogicException;

class StringCache
{
    public ?string $value = null
    {
        set {
            if (!is_null($this->value)) {
                throw new LogicException('Value is already set');
            }
            $this->value = $value;
        }
    }
}