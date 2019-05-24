<?php

namespace DBClass\MySQL;

use DBClass\MySQL\Traits;
use DBClass\MySQL\Exceptions;
use DBClass\MySQL\Interfaces;

abstract class Column implements Interfaces\Column
{
    use Traits\Name;
    use Traits\Comment;
    use Traits\Nullable;
    use Traits\TableName;
    use Traits\DatabaseName;

    private $type;

    abstract public function isTypeValid(string $type): bool;
    abstract public function getBuild(): string;

    final public function setType(string $type): self
    {
        if (! $this->isTypeValid($type)) {
            throw new Exceptions\Column(sprintf('Invalid column type: "%s"', $type));
        }

        $this->type = $type;
        return $this;
    }

    final public function getType(): string
    {
        return $this->type;
    }

    public function isAutoIncrement(): bool
    {
        return false;
    }

    final public static function datetime(string $name): self
    {
        return new ColumnDateTime($name);
    }

    final public static function createdAt(string $name = 'created_at'): self
    {
        return (new ColumnDateTime($name))->setDefaultCurrent();
    }

    final public static function updatedAt(string $name = 'updated_at'): self
    {
        return (new ColumnDateTime($name))->setDefaultCurrent()->setOnUpdateCurrent();
    }

    final public static function deletedAt(string $name = 'deleted_at'): self
    {
        return (new ColumnDateTime($name))->setNullable();
    }

    final public static function char(string $name, int $length): self
    {
        return new ColumnChar($name, $length);
    }

    final public static function tinyint(string $name, ?int $digits = null): self
    {
        return new ColumnInt($name, 'tinyint', $digits);
    }

    final public static function smallint(string $name, ?int $digits = null): self
    {
        return new ColumnInt($name, 'smallint', $digits);
    }

    final public static function mediumint(string $name, ?int $digits = null): self
    {
        return new ColumnInt($name, 'mediumint', $digits);
    }

    final public static function int(string $name, ?int $digits = null): self
    {
        return new ColumnInt($name, 'int', $digits);
    }

    final public static function bigint(string $name, ?int $digits = null): self
    {
        return new ColumnInt($name, 'bigint', $digits);
    }
}
