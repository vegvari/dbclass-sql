<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Interfaces;

trait Builder
{
    private $builder_class;
    private $builder;
    private $data = [];

    public function setBuilderClass(string $class_name): Interfaces\Statement
    {
        $this->builder_class;
        return $this;
    }

    public function getBuilderClass(): string
    {
        return $this->builder_class;
    }

    public function hasBuilderClass(): bool
    {
        return $this->builder_class !== null;
    }

    public function getDefaultBuilder(): string
    {
        return self::DEFAULT_BUILDER;
    }

    public function hasDefaultBuilder(): bool
    {
        return self::DEFAULT_BUILDER !== null;
    }

    public function setBuilder(Interfaces\Builder $builder): Interfaces\Statement
    {
        $this->builder = $builder;
        return $this;
    }

    public function getBuilder(): Interfaces\Builder
    {
        if ($this->hasBuilderClass()) {
            $builder = $this->getBuilderClass();
            return new $builder();
        }

        if (! $this->hasBuilder()) {
            $builder = $this->getDefaultBuilder();
            return new $builder();
        }

        return $this->builder;
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
