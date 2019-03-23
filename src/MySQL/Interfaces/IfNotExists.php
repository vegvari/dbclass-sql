<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface IfNotExists
{
    public function setIfNotExists(bool $value): self;
    public function getIfNotExists(): bool;
    public function ifNotExists(): self;
}
