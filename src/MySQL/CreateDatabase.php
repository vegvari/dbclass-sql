<?php

namespace DBClass\SQL\MySQL;

class CreateDatabase implements Interfaces\DDLStatement
{
    use Traits\Name;
    use Traits\Builder;
    use Traits\Charset;
    use Traits\Collation;
    use Traits\IfNotExists;

    const DEFAULT_BUILDER_CLASS = CreateDatabaseBuilder::class;

    final public function __construct(string $name)
    {
        $this->setName($name);
    }
}
