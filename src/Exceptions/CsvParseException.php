<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Exceptions;

class CsvParseException extends ParserException
{
    protected $message = 'Error parsing CSV:';
}
