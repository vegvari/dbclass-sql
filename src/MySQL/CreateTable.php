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

        $build[] = sprintf('ENGINE `%s`', $this->getEngine());
        $build[] = sprintf('CHARACTER SET `%s`', $this->getCharset());
        $build[] = sprintf('COLLATE `%s`', $this->getCollation());

        if ($this->hasComment()) {
            $build[] = sprintf('COMMENT \'%s\'', $this->getComment());
        }

        return implode(' ', $build) . ';';
    }
}
