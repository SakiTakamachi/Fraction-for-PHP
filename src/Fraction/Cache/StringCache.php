<?php

namespace Saki\Fraction\Cache;

use LogicException;

class StringCache
{
    public ?string $value = null;

    public function get(): ?string
    {
        return $this->value;
    }

    public function set(string $value): void
    {
        if (!is_null($this->value)) {
            // @codeCoverageIgnoreStart
            throw new LogicException('Value is already set');
            // @codeCoverageIgnoreEnd
        }
        $this->value = $value;
    }
}