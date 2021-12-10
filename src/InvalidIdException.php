<?php

namespace PhpCleanArch\Id;

use InvalidArgumentException;

final class InvalidIdException extends InvalidArgumentException
{
    public function __construct(int $id)
    {
        parent::__construct(
            "The {$id} is invalid, it should be strictly positive"
        );
    }
}
