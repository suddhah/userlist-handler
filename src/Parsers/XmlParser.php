<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Parsers;

use Suddhah\UserListHandler\Contracts\ParserInterface;
use Suddhah\UserListHandler\Exceptions\EmptyDataException;
use Suddhah\UserListHandler\Exceptions\InvalidFormatException;
use Suddhah\UserListHandler\Exceptions\ParserException;

class XmlParser implements ParserInterface
{
    public function parse(string $data): array
    {
        $result = [];

        try {
            if (empty($data)) {
                throw new EmptyDataException();
            }

            libxml_use_internal_errors(true);
            $xmlObject = simplexml_load_string($data);
            if ($xmlObject === false) {
                $errorMessage = "";
                foreach (libxml_get_errors() as $error) {
                    $errorMessage .= "\t$error->message";
                }
                throw new InvalidFormatException($errorMessage);
            } else {
                $users = $xmlObject->user;
                foreach ($users as $user) {
                    $result[] = get_object_vars($user);
                }
            }
        } catch (ParserException $e) {
            throw $e;
        }

        return $result;
    }
}
