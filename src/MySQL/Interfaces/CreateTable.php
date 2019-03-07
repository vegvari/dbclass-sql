<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface CreateTable extends DDLStatement
{
    public function setName(string $name): self;
    public function getName(): string;
    public function ifExists(): self;
    public function ifNotExists(): self;
    public function setCharset(string $charset = null): self;
    public function getCharset(): string;
    public function setCollation(string $collation = null): self;
    public function getCollation(): string;
}
