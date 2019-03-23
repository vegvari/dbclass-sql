<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Name
{
    public function setName(string $name);
    public function getName(): string;
}
