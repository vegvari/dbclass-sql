<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Builder
{
    public function getBuild(Statement $statement): string;
}
