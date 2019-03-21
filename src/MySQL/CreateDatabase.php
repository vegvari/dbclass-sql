<?php

namespace DBClass\SQL\MySQL;

final class CreateDatabase implements Interfaces\CreateDatabase
{
    use Traits\Builder;

    const DEFAULT_BUILDER = CreateDatabaseBuilder::class;

    private $name;
    private $if_not_exists = false;
    private $charset = self::DEFAULT_CHARSET;
    private $collation = self::DEFAULT_COLLATION;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function setName(string $name): Interfaces\CreateDatabase
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setIfNotExists(bool $value): Interfaces\CreateDatabase
    {
        $this->if_not_exists = $value;
        return $this;
    }

    public function getIfNotExists(): bool
    {
        return $this->if_not_exists;
    }

    public function ifNotExists(): Interfaces\CreateDatabase
    {
        return $this->setIfNotExists(true);
    }

    public function setCharset(string $charset = null): Interfaces\CreateDatabase
    {
        if ($charset === null) {
            $charset = self::DEFAULT_CHARSET;
        }

        $this->charset = $charset;
        return $this;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }

    public function setCollation(string $collation = null): Interfaces\CreateDatabase
    {
        if ($collation === null) {
            $collation = self::DEFAULT_COLLATION;
        }

        $this->collation = $collation;
        return $this;
    }

    public function getCollation(): string
    {
        return $this->collation;
    }
}
