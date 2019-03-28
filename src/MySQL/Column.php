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
    use Traits\Unsigned;
    use Traits\TableName;
    use Traits\DatabaseName;

    private $type;
    private $auto_increment = false;

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

    final public function setAutoIncrement(bool $value = true): self
    {
        $this->auto_increment = $value;
        return $this;
    }

    final public function isAutoIncrement(): bool
    {
        return $this->auto_increment;
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
