<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface CreateTable extends DDLStatement
{
    const DEFAULT_ENGINE = 'InnoDB';

    public function setName(string $name): self;
    public function getName(): string;
    public function ifExists(): self;
    public function ifNotExists(): self;
    public function setEngine(string $engine = null): self;
    public function getEngine(): string;
    public function setCharset(string $charset = null): self;
    public function getCharset(): string;
    public function setCollation(string $collation = null): self;
    public function getCollation(): string;
    public function setComment(string $comment = null): self;
    public function getComment(): ?string;
    public function hasComment(): bool;
}
