<?php

namespace DBClass\SQL\MySQL;

final class DropTable implements Interfaces\DropTable
{
    use Traits\Name;
    use Traits\Builder;
    use Traits\IfExists;

    const DEFAULT_BUILDER_CLASS = DropTableBuilder::class;

    public function __construct(string $name)
    {
        $this->setName($name);
    }
}
