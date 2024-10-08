<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Parsers;

use Suddhah\UserListHandler\Contracts\ParserInterface;
use Suddhah\UserListHandler\Exceptions\EmptyDataException;
use Suddhah\UserListHandler\Exceptions\InvalidFormatException;
use Suddhah\UserListHandler\Exceptions\ParserException;

class JsonParser implements ParserInterface
{
    public function parse(string $data): array
    {
        try {
            $json = json_decode($data, true);
            if (empty($json['users'])) {
                throw new EmptyDataException();
            }
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidFormatException("Invalid JSON provided.");
            }
        } catch (ParserException $e) {
            throw $e;
        }

        return $json['users'] ?? [];
    }
}
