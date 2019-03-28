<?php

namespace DBClass\MySQL\Interfaces;

interface Builder
{
    public function getBuild(Statement $statement): string;
}
