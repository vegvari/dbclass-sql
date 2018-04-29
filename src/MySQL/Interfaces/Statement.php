<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Statement
{
    public function build(): string;
}
