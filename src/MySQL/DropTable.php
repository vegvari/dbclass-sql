<?php

namespace DBClass\MySQL;

class DropTable implements Interfaces\DDLStatement
{
    use Traits\Name;
    use Traits\Builder;
    use Traits\IfExists;
    use Traits\DatabaseName;

    const DEFAULT_BUILDER_CLASS = DropTableBuilder::class;

    final public function __construct(string $name)
    {
        $this->setName($name);
    }
}
