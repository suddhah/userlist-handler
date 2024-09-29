<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Parsers;

use Suddhah\UserListHandler\Contracts\ParserInterface;
use Suddhah\UserListHandler\Exceptions\EmptyDataException;
use Suddhah\UserListHandler\Exceptions\InvalidFormatException;
use Suddhah\UserListHandler\Exceptions\ParserException;

class CsvParser implements ParserInterface
{
    public function parse(string $data): array
    {
        $result = [];

        try {
            if (empty($data)) {
                throw new EmptyDataException();
            }

            $stream = fopen('php://temp', 'r+');
            fwrite($stream, $data);
            rewind($stream);

            $headerKeys = fgetcsv($stream);
            if ($headerKeys === false) {
                fclose($stream);
                throw new InvalidFormatException("Headers are missing or empty.");
            }

            while (($values = fgetcsv($stream)) !== false) {
                if (count($headerKeys) === count($values)) {
                    $result[] = array_combine($headerKeys, $values);
                }
            }

            while (($values = fgetcsv($stream)) !== false) {
                if (count($headerKeys) === count($values)) {
                    $result[] = array_combine($headerKeys, $values);
                } else {
                    throw new InvalidFormatException("The number of values does not match the number of headings in the row.");
                }
            }

            fclose($stream);
        } catch (ParserException $e) {
            throw $e;
        }

        return $result;
    }
}
