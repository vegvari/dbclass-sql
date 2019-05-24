<?php

namespace DBClass\MySQL;

class ColumnChar extends Column implements Interfaces\ColumnChar
{
    use Traits\Length;

    private $default;

    public function __construct(string $name, int $length)
    {
        $this->setName($name);
        $this->setType('char');
        $this->setLength($length);
    }

    final public function isTypeValid(string $type): bool
    {
        return $type === 'char';
    }

    final public function setDefault(?string $value = null): self
    {
        $this->default = $value;
        return $this;
    }

    final public function getDefault(): string
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
        } elseif ($this->isNullable()) {
            $build[] = 'DEFAULT NULL';
        }

        if ($this->hasComment()) {
            $build[] = sprintf('COMMENT \'%s\'', $this->getComment());
        }

        return implode(' ', $build);
    }
}
