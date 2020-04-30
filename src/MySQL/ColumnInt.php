<?php

namespace DBClass\MySQL;

class ColumnInt extends Column implements Interfaces\ColumnInt
{
    use Traits\Unsigned;

    const DIGITS = [
        'tinyint'   =>  4,
        'smallint'  =>  6,
        'mediumint' =>  9,
        'int'       => 11,
        'bigint'    => 20,
    ];

    private $digits;
    private $default;
    private $auto_increment = false;

    public function __construct(string $name, string $type, ?int $digits = null)
    {
        $this->setName($name);
        $this->setType($type);
        $this->setDigits($digits);
    }

    final public function isTypeValid(string $type): bool
    {
        return in_array($type, array_keys(self::DIGITS), true);
    }

    final public function setDigits(?int $digits = null): self
    {
        $this->digits = $digits;
        return $this;
    }

    final public function getDigits(): int
    {
        if ($this->digits !== null) {
            return $this->digits;
        }

        $digits = self::DIGITS[$this->getType()];
        if ($this->isUnsigned() && $this->getType() !== 'bigint') {
            $digits = $digits - 1;
        }

        return $digits;
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

    final public function setDefault(?int $value = null): self
    {
        $this->default = $value;
        return $this;
    }

    final public function getDefault(): int
    {
        return $this->default;
    }

    final public function hasDefault(): bool
    {
        return $this->default !== null;
    }

    final public function getBuild(): string
    {
        $build[] = sprintf('`%s`', $this->getName());
        $build[] = sprintf('%s(%d)', strtolower($this->getType()), $this->getDigits());

        if ($this->isUnsigned()) {
            $build[] = 'unsigned';
        }

        if (! $this->isNullable()) {
            $build[] = 'NOT NULL';
        }

        if ($this->hasDefault()) {
            $build[] = sprintf('DEFAULT \'%s\'', $this->getDefault());
        }

        if (! $this->hasDefault() && $this->isNullable()) {
            $build[] = 'DEFAULT NULL';
        }

        if ($this->isAutoIncrement()) {
            $build[] = 'AUTO_INCREMENT';
        }

        if ($this->hasComment()) {
            $build[] = sprintf('COMMENT \'%s\'', $this->getComment());
        }

        return implode(' ', $build);
    }
}
