<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Charset
{
    const DEFAULT_CHARSET = 'utf8mb4';

    public function setCharset(string $charset = self::DEFAULT_CHARSET);
    public function getCharset(): string;
}
