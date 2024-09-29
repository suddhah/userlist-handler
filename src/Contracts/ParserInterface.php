<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Contracts;

interface ParserInterface
{
    public function parse(string $data): array;
}
