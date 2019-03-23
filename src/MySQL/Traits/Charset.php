<?php

namespace DBClass\SQL\MySQL\Traits;

trait Charset
{
    private $charset = self::DEFAULT_CHARSET;

    public function setCharset(string $charset = self::DEFAULT_CHARSET): self
    {
        $this->charset = $charset;
        return $this;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }
}
