<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Interfaces;

trait Builder
{
    private $builder;
    private $data = [];

    public function setBuilder(Interfaces\Builder $builder): Interfaces\Statement
    {
        $this->builder = $builder;
        return $this;
    }

    public function getBuilder(): Interfaces\Builder
    {
        if ($this->hasBuilder()) {
            return $this->builder;
        }

        $builder = self::DEFAULT_BUILDER_CLASS;
        return new $builder();
    }

    public function hasBuilder(): bool
    {
        return $this->builder !== null;
    }

    public function getBuild(): string
    {
        return $this->getBuilder()->getBuild($this);
    }

    public function getData(): array
    {
        return $this->data;
    }
}
