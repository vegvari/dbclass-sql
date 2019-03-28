<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Interfaces;

trait Builder
{
    private $builder;
    private $data = [];

    final public function setBuilder(Interfaces\Builder $builder): Interfaces\Statement
    {
        $this->builder = $builder;
        return $this;
    }

    final public function getBuilder(): Interfaces\Builder
    {
        if ($this->hasBuilder()) {
            return $this->builder;
        }

        $builder = self::DEFAULT_BUILDER_CLASS;
        return new $builder();
    }

    final public function hasBuilder(): bool
    {
        return $this->builder !== null;
    }

    final public function getBuild(): string
    {
        return $this->getBuilder()->getBuild($this);
    }

    final public function getData(): array
    {
        return $this->data;
    }
}
