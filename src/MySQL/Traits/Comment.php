<?php

namespace DBClass\MySQL\Traits;

trait Comment
{
    private $comment;

    final public function setComment(?string $comment = null): self
    {
        $this->comment = $comment;
        return $this;
    }

    final public function getComment(): ?string
    {
        return $this->comment;
    }

    final public function hasComment(): bool
    {
        return $this->comment !== null;
    }
}
