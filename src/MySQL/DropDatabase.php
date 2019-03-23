<?php

namespace DBClass\SQL\MySQL;

class DropDatabase implements Interfaces\DDLStatement
{
    use Traits\Name;
    use Traits\Builder;
    use Traits\IfExists;

    const DEFAULT_BUILDER_CLASS = DropDatabaseBuilder::class;

    final public function __construct(string $name)
    {
        $this->setName($name);
    }
}
