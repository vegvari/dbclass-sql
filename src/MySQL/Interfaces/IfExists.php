<?php

namespace DBClass\MySQL\Interfaces;

interface IfExists
{
    public function setIfExists(bool $value);
    public function getIfExists(): bool;
    public function ifExists();
}
