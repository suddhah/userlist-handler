<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Tests\Unit;

use Suddhah\UserListHandler\Tests\TestCase;

class ParserTypeDetectorTest extends TestCase
{
    public function testRunThrowsExceptionForUnsupportedData(): void
    {
        $filename = basename('./tests/Fixtures/data.csv');
        $this->assertEquals('csv', detect_type_by_name($filename));
    }
}
