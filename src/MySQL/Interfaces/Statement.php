<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Statement
{
    public function getBuild(): string;
    public function getData(): array;
}
