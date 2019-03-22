<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Interfaces;

trait Charset
{
    private $charset = self::DEFAULT_CHARSET;

    public function setCharset(string $charset = self::DEFAULT_CHARSET): Interfaces\Charset
    {
        $this->charset = $charset;
        return $this;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }
}
