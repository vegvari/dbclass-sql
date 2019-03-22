<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface CreateTable extends DDLStatement, Charset, Collation
{
    const DEFAULT_ENGINE = 'InnoDB';

    public function setName(string $name): self;
    public function getName(): string;

    public function setDatabaseName(?string $database_name = null): self;
    public function getDatabaseName(): ?string;
    public function hasDatabaseName(): bool;

    public function setIfNotExists(bool $value): self;
    public function getIfNotExists(): bool;
    public function ifNotExists(): self;

    public function setEngine(string $engine = self::DEFAULT_ENGINE): self;
    public function getEngine(): string;

    public function setComment(?string $comment = null): self;
    public function getComment(): ?string;
    public function hasComment(): bool;
}
