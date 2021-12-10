<?php

namespace PhpCleanArch\Id\Tests;

use Generator;
use PHPUnit\Framework\TestCase;
use PhpCleanArch\Id\InvalidIdException;

/**
 * @covers \PhpCleanArch\Id\InvalidIdException
 */
final class InvalidIdExceptionTest extends TestCase
{
    public function idProvider(): Generator
    {
        yield [-42, 0, 13];
    }

    /**
     * @test
     * @dataProvider idProvider
     */
    public function shows_id_in_error_message(int $id): void
    {
        // given an exception for some id
        $exception = new InvalidIdException($id);

        // when checking its error message
        $errorMessage = $exception->getMessage();

        $this->assertStringContainsString(
            needle: $id,
            haystack: $errorMessage,
            message: "Exception should show incriminated id '{$id}' in error message",
        );
    }
}
