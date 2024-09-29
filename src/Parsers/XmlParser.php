<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Parsers;

use Suddhah\UserListHandler\Contracts\ParserInterface;
use Suddhah\UserListHandler\Exceptions\XmlParseException;

class XmlParser implements ParserInterface
{
    public function parse(string $data): array
    {
        $result = [];

        try {
            if (empty($data)) {
                throw new XmlParseException("Input data is empty.");
            }

            libxml_use_internal_errors(true);
            $xmlObject = simplexml_load_string($data);
            if ($xmlObject === false) {
                $errorMessage = "";
                foreach (libxml_get_errors() as $error) {
                    $errorMessage .= "\t$error->message";
                }
                throw new XmlParseException($errorMessage);
            } else {
                $users = $xmlObject->user;
                foreach ($users as $user) {
                    $result[] = get_object_vars($user);
                }
            }
        } catch (XmlParseException $e) {
            throw $e;
        }

        return $result;
    }
}
