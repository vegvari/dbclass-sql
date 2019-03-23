<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Charset
{
    public function setCharset(string $charset = self::DEFAULT_CHARSET);
    public function getCharset(): string;
}
