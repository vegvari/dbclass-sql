<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Statement extends MySQL
{
    public function setBuilder(Builder $builder): self;
    public function getBuilder(): Builder;
    public function hasBuilder(): bool;

    public function getBuild(): string;
    public function getData(): array;
}
