<?php

namespace PhpCleanArch\Id\Tests;

use Generator;
use PHPUnit\Framework\TestCase;
use PhpCleanArch\Id\Id;
use PhpCleanArch\Id\IdInterface;
use PhpCleanArch\Id\InvalidIdException;
use PhpCleanArch\ValueObjects\ValueObjectInterface;

/**
 * @covers \PhpCleanArch\Id\Id
 */
final class IdTest extends TestCase
{
    public function createInstance(int $id = 1): IdInterface
    {
        return new Id($id);
    }

    public function valueObjectProvider(): Generator
    {
        $idValue = 42;
        $id = $this->createInstance($idValue);

        yield 'not an Id' => [
            $id,
            new DummyValueObject,
            false
        ];
        yield 'Id with different value' => [
            $id,
            $this->createInstance($idValue + 1),
            false
        ];
        yield 'Same Id' => [
            $id,
            $this->createInstance($idValue),
            true
        ];
    }

    /**
     * @test
     * @dataProvider valueObjectProvider
     */
    public function matches_same_id(IdInterface $id, ValueObjectInterface $other, bool $expectedEquality): void
    {
        // given a value object to compare with

        // when comparing the 2 instances
        $areSameValue = $id->equals($other);

        // when it should match the expected equality
        $this->assertSame(
            expected: $expectedEquality,
            actual: $areSameValue,
        );
    }

    public function invalidIdProvider(): Generator
    {
        yield 'negative' => [-1];
        yield 'null' => [0];
    }

    /**
     * @test
     * @dataProvider invalidIdProvider
     */
    public function requires_positive_id_value(int $invalidId): void
    {
        $this->expectException(InvalidIdException::class);

        // given an invalid id value

        // when creating an Id from it
        $this->createInstance(id: $invalidId);

        // then it should be rejected
    }

    public function integerIdProvider(): Generator
    {
        yield [13, 42, 64];
    }

    /**
     * @test
     * @dataProvider integerIdProvider
     */
    public function formats_to_string(int $idValue): void
    {
        // given a valid integer id value

        // when creating an Id from it
        $id = $this->createInstance(id: $idValue);

        // then its string format should be the vale in a string
        $this->assertSame(
            expected: "{$idValue}",
            actual: (string) $id,
            message: "Id string format shoul contain the id value and nothing else"
        );
    }
}