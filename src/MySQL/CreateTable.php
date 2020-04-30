<?php

namespace DBClass\MySQL;

final class CreateTable implements Interfaces\DDLStatement
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

    public function setDatabaseName(?string $databaseName = null): self
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

    public function setEngine(string $engine = self::DEFAULT_ENGINE): self
    {
        $this->engine = $engine;
        return $this;
    }

    public function getEngine(): string
    {
        return $this->engine;
    }

    public function setCharset(string $charset = self::DEFAULT_CHARSET): self
    {
        $this->charset = $charset;
        return $this;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }

    public function setCollation(string $collation = self::DEFAULT_COLLATION): self
    {
        $this->collation = $collation;
        return $this;
    }

    public function getCollation(): string
    {
        return $this->collation;
    }

    public function setColumn(Interfaces\Column ...$columns): self
    {
        foreach ($columns as $column) {
            if ($this->hasColumn($column->getName())) {
                throw new Exceptions\Table(sprintf('Column is already set: "%s"', $column->getName()));
            }

            $this->columns[$column->getName()] = $column;
        }

        return $this;
    }

    public function getColumn(string $name): Interfaces\Column
    {
        if (! $this->hasColumn($name)) {
            throw new Exceptions\Table(sprintf('Column is not set: "%s"', $name));
        }

        return $this->columns[$name];
    }

    public function getColumns(string ...$names): array
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

    public function hasColumn(string $name): bool
    {
        return array_key_exists($name, $this->columns);
    }

    public function setComment(?string $comment = null): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function hasComment(): bool
    {
        return $this->comment !== null;
    }

    public function getBuild(): string
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
