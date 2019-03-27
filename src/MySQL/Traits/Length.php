<?php

namespace DBClass\SQL\MySQL\Traits;

trait Length
{
    private $length;

    final public function setLength(int $length): self
    {
        $this->length = $length;
        return $this;
    }

    final public function getLength(): int
    {
        return $this->length;
    }
}
