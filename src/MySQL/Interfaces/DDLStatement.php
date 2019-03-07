<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface DDLStatement extends Statement
{
    const DEFAULT_CHARSET = 'utf8mb4';
    const DEFAULT_COLLATION = 'utf8mb4_unicode_ci';
}
