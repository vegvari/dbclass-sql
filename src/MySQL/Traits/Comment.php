<?php

namespace DBClass\SQL\MySQL\Traits;

trait Comment
{
    private $comment;

    public function setComment(?string $comment = null): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function hasComment(): bool
    {
        return $this->comment !== null;
    }
}
