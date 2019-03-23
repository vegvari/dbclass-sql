<?php

namespace DBClass\SQL\MySQL;

final class CreateDatabase implements Interfaces\CreateDatabase
{
    use Traits\Name;
    use Traits\Builder;
    use Traits\Charset;
    use Traits\Collation;
    use Traits\IfNotExists;

    const DEFAULT_BUILDER_CLASS = CreateDatabaseBuilder::class;

    public function __construct(string $name)
    {
        $this->setName($name);
    }
}
