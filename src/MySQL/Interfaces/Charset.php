<?php

namespace DBClass\MySQL\Interfaces;

interface Charset
{
    public function setCharset(string $charset = self::DEFAULT_CHARSET);
    public function getCharset(): string;
}
