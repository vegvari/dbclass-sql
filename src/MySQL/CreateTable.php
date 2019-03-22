<?php

namespace DBClass\SQL\MySQL;

final class CreateTable implements Interfaces\CreateTable
{
    use Traits\Builder;
    use Traits\Charset;
    use Traits\Collation;

    const DEFAULT_BUILDER_CLASS = CreateTableBuilder::class;

    private $name;
    private $if_not_exists = false;
    private $engine = self::DEFAULT_ENGINE;
    private $comment;

    public function __construct(string $name, string $database_name = null)
    {
        $this->setName($name);
        $this->setDatabaseName($database_name);
    }

    public function setName(string $name): Interfaces\CreateTable
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDatabaseName(string $database_name = null): Interfaces\CreateTable
    {
        $this->database_name = $database_name;
        return $this;
    }

    public function getDatabaseName(): string
    {
        return $this->database_name;
    }

    public function hasDatabaseName(): bool
    {
        return $this->database_name !== null;
    }

    public function setIfNotExists(bool $value): Interfaces\CreateTable
    {
        $this->if_not_exists = $value;
        return $this;
    }

    public function getIfNotExists(): bool
    {
        return $this->if_not_exists;
    }

    public function ifNotExists(): Interfaces\CreateTable
    {
        return $this->setIfNotExists(true);
    }

    public function setEngine(string $engine = self::DEFAULT_ENGINE): Interfaces\CreateTable
    {
        $this->engine = $engine;
        return $this;
    }

    public function getEngine(): string
    {
        return $this->engine;
    }

    public function setComment(string $comment = null): Interfaces\CreateTable
    {
        $this->comment = $comment;
        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function hasComment(): bool
    {
        return $this->comment !== null;
    }
}
