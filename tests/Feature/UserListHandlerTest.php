<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Tests\Feature;

use Suddhah\UserListHandler\Exceptions\ParserException;
use Suddhah\UserListHandler\Factories\ParserFactory;
use Suddhah\UserListHandler\Tests\TestCase;
use Suddhah\UserListHandler\UserListHandler;

class UserListHandlerTest extends TestCase
{
    public function test_user_list_handler(): void
    {
        $data = file_get_contents('./tests/Fixtures/data.csv');

        $parserRegistry = ParserFactory::createParserRegistry();
        $userListHandler = new UserListHandler($parserRegistry);
        $result = $userListHandler->run($data, UserListHandler::TYPE_CSV);

        $this->assertCount(3, $result);

        $this->expectException(ParserException::class);
        $userListHandler->run($data, 'yaml');
    }
}
