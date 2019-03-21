<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Statement
{
    public function getDefaultBuilder(): string;

    public function setBuilder(Builder $builder): self;
    public function getBuilder(): Builder;

    public function getBuild(): string;
    public function getData(): array;
}
