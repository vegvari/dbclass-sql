<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Statement
{
    public function setBuilder(Builder $builder);
    public function getBuilder(): Builder;
    public function hasBuilder(): bool;

    public function getBuild(): string;
    public function getData(): array;
}
