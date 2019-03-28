<?php

namespace DBClass\MySQL\Interfaces;

interface Statement extends MySQL
{
    public function getBuild(): string;
}
