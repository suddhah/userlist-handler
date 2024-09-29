<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Exceptions;

class InvalidFormatException extends ParserException
{
    protected $message = 'Incorrect data format:';
}