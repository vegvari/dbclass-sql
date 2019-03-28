<?php

namespace DBClass\MySQL\Interfaces;

interface CreateTable extends DDLStatement, Name, DatabaseName, IfNotExists, Charset, Collation, Comment
{
    public function setEngine(string $engine = self::DEFAULT_ENGINE);
    public function getEngine(): string;
}
