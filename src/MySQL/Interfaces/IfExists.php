<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface IfExists
{
    public function setIfExists(bool $value);
    public function getIfExists(): bool;
    public function ifExists();
}
