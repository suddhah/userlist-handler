<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Exceptions;

class ParserException extends \InvalidArgumentException
{
    protected $message = 'Parser error:';

    public function __construct($message = "")
    {
        parent::__construct($this->message . ' ' . $message);
    }
}
