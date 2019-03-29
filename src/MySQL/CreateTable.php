<?php

namespace DBClass\MySQL;

class CreateTable implements Interfaces\DDLStatement
{
    use Traits\Name;
    use Traits\Charset;
    use Traits\Comment;
    use Traits\Collation;
    use Traits\IfNotExists;
    use Traits\DatabaseName;

    private $engine = self::DEFAULT_ENGINE;
    private $columns = [];

    final public function __construct(string $name, ?string $database_name = null)
    {
        $this->setName($name);
        $this->setDatabaseName($database_name);
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

    final public function getBuild(): string
    {
        $build[] = 'CREATE TABLE';

        if ($this->getIfNotExists()) {
            $build[] = 'IF NOT EXISTS';
        }

        $name = sprintf('`%s`', $this->getName());
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
