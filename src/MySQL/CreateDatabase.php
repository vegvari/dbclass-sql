<?php

namespace DBClass\SQL\MySQL;

final class CreateDatabase implements Interfaces\CreateDatabase
{
    use Traits\Name;
    use Traits\Builder;
    use Traits\Charset;
    use Traits\Collation;

    const DEFAULT_BUILDER_CLASS = CreateDatabaseBuilder::class;

    private $if_not_exists = false;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function setIfNotExists(bool $value): Interfaces\CreateDatabase
    {
        $this->if_not_exists = $value;
        return $this;
    }

    public function getIfNotExists(): bool
    {
        return $this->if_not_exists;
    }

    public function ifNotExists(): Interfaces\CreateDatabase
    {
        return $this->setIfNotExists(true);
    }
}
