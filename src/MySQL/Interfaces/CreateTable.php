<?php

namespace DBClass\MySQL\Interfaces;

interface CreateTable extends DDLStatement
{
    public function setName(string $name);
    public function getName(): string;

    public function setDatabaseName(?string $database_name = null);
    public function getDatabaseName(): ?string;
    public function hasDatabaseName(): bool;

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
