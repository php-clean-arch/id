<?php

namespace PhpCleanArch\Id;

use PhpCleanArch\ValueObjects\ValueObjectInterface;

final class Id implements IdInterface
{
    public function __construct(private int $id)
    {
        if ($id <= 0) {
            throw new InvalidIdException($id);
        }
    }

    public function nativeFormat(): int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return "{$this->id}";
    }

    public function equals(ValueObjectInterface $other): bool
    {
        if ($other instanceof IdInterface) {
            return $this->nativeFormat() === $other->nativeFormat();
        }

        return false;
    }
}
