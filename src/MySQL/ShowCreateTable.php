<?php

namespace DBClass\MySQL;

class ShowCreateTable implements Interfaces\DDLStatement
{
    use Traits\Name;
    use Traits\DatabaseName;

    final public function __construct(string $name, ?string $database_name = null)
    {
        $this->setName($name);
        $this->setDatabaseName($database_name);
    }

    final public function getBuild(): string
    {
        $build[] = 'SHOW CREATE TABLE';

        $name = sprintf('`%s`', $this->getName());
        if ($this->hasDatabaseName()) {
            $name = sprintf('`%s`.', $this->getDatabaseName()) . $name;
        }
        $build[] = $name;

        return implode(' ', $build);
    }
}
