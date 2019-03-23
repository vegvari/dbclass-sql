<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Interfaces;

trait IfExists
{
    private $if_exists = false;

    public function setIfExists(bool $value): Interfaces\IfExists
    {
        $this->if_exists = $value;
        return $this;
    }

    public function getIfExists(): bool
    {
        return $this->if_exists;
    }

    public function ifExists(): Interfaces\IfExists
    {
        return $this->setIfExists(true);
    }
}
