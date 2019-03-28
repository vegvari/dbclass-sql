<?php

namespace DBClass\MySQL;

class CreateDatabase implements Interfaces\DDLStatement
{
    use Traits\Name;
    use Traits\Charset;
    use Traits\Collation;
    use Traits\IfNotExists;

    final public function __construct(string $name)
    {
        $this->setName($name);
    }

    final public function getBuild(): string
    {
        $build[] = 'CREATE DATABASE';

        if ($this->getIfNotExists()) {
            $build[] = 'IF NOT EXISTS';
        }

        $build[] = sprintf('`%s`', $this->getName());
        $build[] = sprintf('CHARACTER SET `%s`', $this->getCharset());
        $build[] = sprintf('COLLATE `%s`', $this->getCollation());

        return implode(' ', $build) . ';';
    }
}
