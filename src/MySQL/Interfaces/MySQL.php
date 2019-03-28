<?php

namespace DBClass\MySQL\Interfaces;

interface MySQL
{
    const DEFAULT_ENGINE = 'InnoDB';
    const DEFAULT_CHARSET = 'utf8mb4';
    const DEFAULT_COLLATION = 'utf8mb4_unicode_ci';

    public function getBuild(): string;
}
