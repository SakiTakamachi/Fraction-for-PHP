<?php

namespace Saki\Fraction\Cache;

use BcMath\Number;
use LogicException;

class NumberCache
{
    public ?Number $value = null
    {
        set {
            if (!is_null($this->value)) {
                throw new LogicException('Value is already set');
            }
            $this->value = $value;
        }
    }
}