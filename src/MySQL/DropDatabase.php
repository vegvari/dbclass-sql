<?php

namespace DBClass\SQL\MySQL;

final class DropDatabase implements Interfaces\DropDatabase
{
    use Traits\Name;
    use Traits\Builder;
    use Traits\IfExists;

    const DEFAULT_BUILDER_CLASS = DropDatabaseBuilder::class;

    private $name;

    public function __construct(string $name)
    {
        $this->setName($name);
    }
}
