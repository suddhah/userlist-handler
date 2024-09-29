<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;
use Suddhah\UserListHandler\UserListHandler;

class Facade extends BaseFacade
{
    protected static function getFacadeAccessor(): string
    {
        return UserListHandler::class;
    }
}
