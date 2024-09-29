<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Exceptions;

class XmlParseException extends ParserException
{
    protected $message = 'Error parsing XML:';
}
