<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Interfaces;

trait IfNotExists
{
    private $if_not_exists = false;

    public function setIfNotExists(bool $value): Interfaces\IfNotExists
    {
        $this->if_not_exists = $value;
        return $this;
    }

    public function getIfNotExists(): bool
    {
        return $this->if_not_exists;
    }

    public function ifNotExists(): Interfaces\IfNotExists
    {
        return $this->setIfNotExists(true);
    }
}
