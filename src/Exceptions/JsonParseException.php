<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Exceptions;

class JsonParseException extends ParserException
{
    protected $message = 'Error parsing JSON:';
}
