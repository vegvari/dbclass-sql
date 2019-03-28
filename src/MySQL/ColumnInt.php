<?php

namespace DBClass\MySQL;

class ColumnInt extends Column
{
    const TYPES = [
        'tinyint',
        'smallint',
        'mediumint',
        'int',
        'bigint',
    ];

    const DIGITS = [
        'tinyint'   =>  4,
        'smallint'  =>  6,
        'mediumint' =>  9,
        'int'       => 11,
        'bigint'    => 20,
    ];

    private $digits;

    public function __construct(string $name, string $type, ?int $digits = null)
    {
        $this->setName($name);
        $this->setType($type);
        $this->setDigits($digits);
    }

    final protected function checkType(string $type): bool
    {
        return ! in_array($type, self::TYPES, true);
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

    final public function getBuild(): string
    {
        $build[] = sprintf('`%s`', $this->getName());
        $build[] = sprintf('%s(%d)', strtoupper($this->getType()), $this->getDigits());

        if ($this->isUnsigned()) {
            $build[] = 'UNSIGNED';
        }

        $nullable = 'NOT NULL';
        if ($this->isNullable()) {
            $nullable = 'NULL';
        }
        $build[] = $nullable;

        $default = 'DEFAULT NULL';
        if ($this->isNullable()) {
            $default = sprintf('DEFAULT "%s"', $this->getDefault());
        }
        $build[] = $default;

        if ($this->isAutoIncrement()) {
            $build[] = 'AUTO_INCREMENT';
        }

        if ($this->hasComment()) {
            $default = sprintf('COMMENT "%s"', $this->getComment());
        }

        return implode(' ', $build);
    }
}
