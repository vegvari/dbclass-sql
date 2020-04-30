<?php

namespace DBClass\MySQL;

class CreateTable implements Interfaces\DDLStatement
{
    private $databaseName;
    private $tableName;
    private $ifNotExists = false;
    private $charset = self::DEFAULT_CHARSET;
    private $collation = self::DEFAULT_COLLATION;
    private $engine = self::DEFAULT_ENGINE;
    private $columns = [];
    private $comment;

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    public function setDatabaseName(string $databaseName): self
    {
        $this->databaseName = $databaseName;
        return $this;
    }

    public function getDatabaseName(): string
    {
        return $this->databaseName;
    }

    public function hasDatabaseName(): bool
    {
        return $this->databaseName !== null;
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function getName(): string
    {
        return $this->tableName;
    }

    public function setIfNotExists(bool $value = true): self
    {
        $this->ifNotExists = $value;
        return $this;
    }

    public function getIfNotExists(): bool
    {
        return $this->ifNotExists;
    }

    final public function setEngine(string $engine = self::DEFAULT_ENGINE): self
    {
        $this->engine = $engine;
        return $this;
    }

    final public function getEngine(): string
    {
        return $this->engine;
    }

    final public function setCharset(string $charset = self::DEFAULT_CHARSET): self
    {
        $this->charset = $charset;
        return $this;
    }

    final public function getCharset(): string
    {
        return $this->charset;
    }

    final public function setCollation(string $collation = self::DEFAULT_COLLATION): self
    {
        $this->collation = $collation;
        return $this;
    }

    final public function getCollation(): string
    {
        return $this->collation;
    }

    final public function setColumn(Interfaces\Column ...$columns): self
    {
        foreach ($columns as $column) {
            $this->columns[$column->getName()] = $column;
        }

        return $this;
    }

    final public function getColumn(string $name): Interfaces\Column
    {
        if (! $this->hasColumn($name)) {
            throw new Exceptions\Table(sprintf('Column is not set: "%s"', $name));
        }

        return $this->columns[$name];
    }

    final public function getColumns(string ...$names): array
    {
        if ($names === []) {
            return $this->columns;
        }

        $result = [];
        foreach ($names as $name) {
            $result[$name] = $this->getColumn($name);
        }

        return $result;
    }

    final public function hasColumn(string $name): bool
    {
        return array_key_exists($name, $this->columns);
    }

    final public function setComment(?string $comment = null): self
    {
        $this->comment = $comment;
        return $this;
    }

    final public function getComment(): ?string
    {
        return $this->comment;
    }

    final public function hasComment(): bool
    {
        return $this->comment !== null;
    }

    final public function getBuild(): string
    {
        $build[] = 'CREATE TABLE';

        if ($this->getIfNotExists()) {
            $build[] = 'IF NOT EXISTS';
        }

        $name = sprintf('`%s`', $this->getTableName());
        if ($this->hasDatabaseName()) {
            $name = sprintf('`%s`.', $this->getDatabaseName()) . $name;
        }
        $build[] = $name;

        $columns = [];
        foreach ($this->getColumns() as $name => $column) {
            $columns[] = sprintf('  %s', $column->getBuild());
        }
        $build[] = sprintf("(\n%s\n)", implode(",\n", $columns));

        $build[] = sprintf('ENGINE=%s', $this->getEngine());
        $build[] = sprintf('DEFAULT CHARSET=%s', $this->getCharset());
        $build[] = sprintf('COLLATE=%s', $this->getCollation());

        if ($this->hasComment()) {
            $build[] = sprintf('COMMENT=\'%s\'', $this->getComment());
        }

        return implode(' ', $build);
    }
}
