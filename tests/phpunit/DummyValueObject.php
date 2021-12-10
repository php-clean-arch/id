<?php

namespace PhpCleanArch\Id\Tests;

use BadMethodCallException;
use PhpCleanArch\ValueObjects\ValueObjectInterface;

final class DummyValueObject implements ValueObjectInterface
{
    public function equals(ValueObjectInterface $other): bool
    {
        throw new BadMethodCallException("Method must be called from concrete instance");
    }
}
