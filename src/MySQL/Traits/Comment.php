<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Interfaces;

trait Comment
{
    private $comment;

    public function setComment(?string $comment = null): Interfaces\Comment
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
