<?php

namespace DBClass\SQL\MySQL;

final class DropTable implements Interfaces\DropTable
{
    use Traits\Builder;

    const DEFAULT_BUILDER_CLASS = DropTableBuilder::class;

    private $name;
    private $if_exists = false;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function setName(string $name): Interfaces\DropTable
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setIfExists(bool $value): Interfaces\DropTable
    {
        $this->if_exists = $value;
        return $this;
    }

    public function getIfExists(): bool
    {
        return $this->if_exists;
    }

    public function ifExists(): Interfaces\DropTable
    {
        return $this->setIfExists(true);
    }

    public function ifNotExists(): Interfaces\DropTable
    {
        $this->if_exists = false;
        return $this;
    }
}
