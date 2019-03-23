<?php

namespace DBClass\SQL\MySQL\Interfaces;

interface Comment
{
    public function setComment(?string $comment = null);
    public function getComment(): ?string;
    public function hasComment(): bool;
}
