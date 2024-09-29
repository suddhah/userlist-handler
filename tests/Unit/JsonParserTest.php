<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Tests\Unit;

use Suddhah\UserListHandler\Exceptions\JsonParseException;
use Suddhah\UserListHandler\Parsers\JsonParser;
use Suddhah\UserListHandler\Tests\TestCase;

class JsonParserTest extends TestCase
{
    public const string TEST_USER_NAME = 'Иван Петров';
    public const string TEST_USER_EMAIL = 'maria@example.com';
    public const int TEST_USER_AGE = 35;

    public function test_json_parser(): void
    {
        $jsonData = file_get_contents('./tests/Fixtures/data.json');
        $parser = new JsonParser();
        $result = $parser->parse($jsonData);

        $this->assertNotEmpty($result);
        $this->assertCount(3, $result);
        $this->assertArrayHasKey('id', $result[0]);
        $this->assertArrayHasKey('name', $result[0]);
        $this->assertArrayHasKey('email', $result[0]);
        $this->assertArrayHasKey('age', $result[0]);
        $this->assertEquals(self::TEST_USER_NAME, $result[0]['name']);
        $this->assertEquals(self::TEST_USER_EMAIL, $result[1]['email']);
        $this->assertEquals(self::TEST_USER_AGE, $result[2]['age']);

        $this->expectException(JsonParseException::class);
        $parser->parse('{"users": []}');
    }
}
