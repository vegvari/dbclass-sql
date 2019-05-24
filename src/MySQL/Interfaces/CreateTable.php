<?php

namespace DBClass\MySQL\Interfaces;

interface CreateTable extends DDLStatement, Name, DatabaseName
{
    public function setIfNotExists(bool $value);
    public function getIfNotExists(): bool;
    public function ifNotExists();

    public function setCharset(string $charset = self::DEFAULT_CHARSET);
    public function getCharset(): string;

    public function setCollation(string $collation = self::DEFAULT_COLLATION);
    public function getCollation(): string;

    public function setComment(?string $comment = null);
    public function getComment(): ?string;
    public function hasComment(): bool;

    public function setEngine(string $engine = self::DEFAULT_ENGINE);
    public function getEngine(): string;
}
