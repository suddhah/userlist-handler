<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Parsers;

use Suddhah\UserListHandler\Contracts\ParserInterface;
use Suddhah\UserListHandler\Exceptions\JsonParseException;

class JsonParser implements ParserInterface
{
    public function parse(string $data): array
    {
        try {
            $json = json_decode($data, true);
            if (empty($json['users'])) {
                throw new JsonParseException("Input data is empty.");
            }
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new JsonParseException("Invalid JSON provided.");
            }
        } catch (JsonParseException $e) {
            throw $e;
        }

        return $json['users'] ?? [];
    }
}
