<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Exceptions;

class EmptyDataException extends ParserException
{
    protected $message = 'Input data is empty.';
}