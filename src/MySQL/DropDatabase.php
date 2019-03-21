<?php

namespace DBClass\SQL\MySQL;

final class DropDatabase implements Interfaces\DropDatabase
{
    use Traits\Builder;

    const DEFAULT_BUILDER_CLASS = DropDatabaseBuilder::class;

    private $name;
    private $if_exists = false;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function setName(string $name): Interfaces\DropDatabase
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setIfExists(bool $value): Interfaces\DropDatabase
    {
        $this->if_exists = $value;
        return $this;
    }

    public function getIfExists(): bool
    {
        return $this->if_exists;
    }

    public function ifExists(): Interfaces\DropDatabase
    {
        return $this->setIfExists(true);
    }
}
