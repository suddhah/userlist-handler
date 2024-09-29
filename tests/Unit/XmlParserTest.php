<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Tests\Unit;

use Suddhah\UserListHandler\Exceptions\XmlParseException;
use Suddhah\UserListHandler\Parsers\XmlParser;
use Suddhah\UserListHandler\Tests\TestCase;

class XmlParserTest extends TestCase
{
    public const string TEST_USER_NAME = 'Иван Петров';
    public const string TEST_USER_EMAIL = 'maria@example.com';
    public const int TEST_USER_AGE = 35;

    public function test_json_parser(): void
    {
        $xmlData = file_get_contents('./tests/Fixtures/data.xml');
        $parser = new XmlParser();
        $result = $parser->parse($xmlData);

        $this->assertNotEmpty($result);
        $this->assertCount(3, $result);
        $this->assertArrayHasKey('id', $result[0]);
        $this->assertArrayHasKey('name', $result[0]);
        $this->assertArrayHasKey('email', $result[0]);
        $this->assertArrayHasKey('age', $result[0]);
        $this->assertEquals(self::TEST_USER_NAME, $result[0]['name']);
        $this->assertEquals(self::TEST_USER_EMAIL, $result[1]['email']);
        $this->assertEquals(self::TEST_USER_AGE, $result[2]['age']);

        $this->expectException(XmlParseException::class);
        $parser->parse('');
    }
}
