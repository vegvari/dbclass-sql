<?php

namespace DBClass\MySQL;

class ShowCreateDatabase implements Interfaces\DDLStatement
{
    use Traits\Name;

    final public function __construct(string $name)
    {
        $this->setName($name);
    }

    final public function getBuild(): string
    {
        $build[] = 'SHOW CREATE DATABASE';
        $build[] = sprintf('`%s`', $this->getName());
        return implode(' ', $build);
    }
}
