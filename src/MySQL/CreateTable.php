<?php

namespace DBClass\MySQL;

class CreateTable implements Interfaces\DDLStatement
{
    use Traits\Name;
    use Traits\Builder;
    use Traits\Charset;
    use Traits\Comment;
    use Traits\Collation;
    use Traits\IfNotExists;
    use Traits\DatabaseName;

    const DEFAULT_BUILDER_CLASS = CreateTableBuilder::class;

    private $engine = self::DEFAULT_ENGINE;

    final public function __construct(string $name, string $database_name = null)
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
}
