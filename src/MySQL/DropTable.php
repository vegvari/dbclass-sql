<?php

namespace DBClass\MySQL;

class DropTable implements Interfaces\DDLStatement
{
    use Traits\Name;
    use Traits\IfExists;
    use Traits\DatabaseName;

    final public function __construct(string $name, ?string $database_name = null)
    {
        $this->setName($name);
        $this->setDatabaseName($database_name);
    }

    final public function getBuild(): string
    {
        $build[] = 'DROP TABLE';

        if ($this->getIfExists()) {
            $build[] = 'IF EXISTS';
        }

        $name = sprintf('`%s`', $this->getName());
        if ($this->hasDatabaseName()) {
            $name = sprintf('`%s`.', $this->getDatabaseName()) . $name;
        }
        $build[] = $name;

        return implode(' ', $build) . ';';
    }
}
