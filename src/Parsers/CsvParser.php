<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Parsers;

use Suddhah\UserListHandler\Contracts\ParserInterface;
use Suddhah\UserListHandler\Exceptions\CsvParseException;

class CsvParser implements ParserInterface
{
    public function parse(string $data): array
    {
        $result = [];

        try {
            if (empty($data)) {
                throw new CsvParseException("Input data is empty.");
            }

            $stream = fopen('php://temp', 'r+');
            fwrite($stream, $data);
            rewind($stream);

            $headerKeys = fgetcsv($stream);
            if ($headerKeys === false) {
                fclose($stream);
                throw new CsvParseException("Headers are missing or empty.");
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
                    throw new CsvParseException("The number of values does not match the number of headings in the row.");
                }
            }

            fclose($stream);
        } catch (CsvParseException $e) {
            throw $e;
        }

        return $result;
    }
}
