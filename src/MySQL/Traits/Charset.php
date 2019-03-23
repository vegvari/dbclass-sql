<?php

namespace DBClass\SQL\MySQL\Traits;

trait Charset
{
    private $charset = self::DEFAULT_CHARSET;

    final public function setCharset(string $charset = self::DEFAULT_CHARSET): self
    {
        $this->charset = $charset;
        return $this;
    }

    final public function getCharset(): string
    {
        return $this->charset;
    }
}
