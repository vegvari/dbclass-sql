<?php

namespace DBClass\MySQL;

class ColumnDateTime extends Column// implements Interfaces\ColumnInt
{
    private $default;
    private $on_update_current = false;

    public function __construct(string $name)
    {
        $this->setName($name);
        $this->setType('datetime');
    }

    final public function isTypeValid(string $type): bool
    {
        return true;
    }

    final public function setDefault(?string $value = null): self
    {
        $this->default = $value;
        return $this;
    }

    final public function setDefaultCurrent(): self
    {
        return $this->setDefault('CURRENT_TIMESTAMP');
    }

    final public function getDefault(): string
    {
        return $this->default;
    }

    final public function hasDefault(): bool
    {
        return $this->default !== null;
    }

    final public function isDefaultCurrent(): bool
    {
        return $this->default === 'CURRENT_TIMESTAMP';
    }

    final public function setOnUpdateCurrent(bool $value = true): self
    {
        $this->on_update_current = $value;
        return $this;
    }

    final public function isOnUpdateCurrent(): bool
    {
        return $this->on_update_current;
    }

    final public function getBuild(): string
    {
        $build[] = sprintf('`%s`', $this->getName());
        $build[] = sprintf('%s', strtolower($this->getType()));

        if (! $this->isNullable()) {
            $build[] = 'NOT NULL';
        }

        $default = 'DEFAULT NULL';
        if ($this->hasDefault()) {
            $default = sprintf('DEFAULT \'%s\'', $this->getDefault());

            if ($this->isDefaultCurrent()) {
                $default = 'DEFAULT CURRENT_TIMESTAMP';
            }
        }
        $build[] = $default;

        if ($this->isOnUpdateCurrent()) {
            $build[] = 'ON UPDATE CURRENT_TIMESTAMP';
        }

        if ($this->hasComment()) {
            $build[] = sprintf('COMMENT \'%s\'', $this->getComment());
        }

        return implode(' ', $build);
    }
}
