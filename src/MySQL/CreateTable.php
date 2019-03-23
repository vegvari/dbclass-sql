<?php

namespace DBClass\SQL\MySQL;

final class CreateTable implements Interfaces\CreateTable
{
    use Traits\Name;
    use Traits\Builder;
    use Traits\Charset;
    use Traits\Comment;
    use Traits\Collation;
    use Traits\IfNotExists;

    const DEFAULT_BUILDER_CLASS = CreateTableBuilder::class;

    private $engine = self::DEFAULT_ENGINE;

    public function __construct(string $name, string $database_name = null)
    {
        $this->setName($name);
        $this->setDatabaseName($database_name);
    }

    public function setDatabaseName(?string $database_name = null): Interfaces\CreateTable
    {
        $this->database_name = $database_name;
        return $this;
    }

    public function getDatabaseName(): ?string
    {
        return $this->database_name;
    }

    public function hasDatabaseName(): bool
    {
        return $this->database_name !== null;
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
}
