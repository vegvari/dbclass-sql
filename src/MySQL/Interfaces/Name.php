<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Name
{
    public function setName(string $name): self;
    public function getName(): string;
}
