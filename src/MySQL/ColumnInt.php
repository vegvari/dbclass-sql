<?php

namespace DBClass\MySQL;

class ColumnInt extends Column
{
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

        $digits = self::DEFAULT_DIGITS[$this->getType()];
        if ($this->isUnsigned() && $this->getType() !== 'bigint') {
            $digits = $digits - 1;
        }

        return $digits;
    }

    final public function getBuild(): string
    {
        return '';
    }
}
