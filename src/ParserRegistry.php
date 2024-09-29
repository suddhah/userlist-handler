<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler;

use Suddhah\UserListHandler\Contracts\ParserInterface;
use Suddhah\UserListHandler\Exceptions\ParserException;

class ParserRegistry
{
    protected array $parsers = [];

    public function register($parserType, ParserInterface $parser): void
    {
        $this->parsers[$parserType] = $parser;
    }

    public function getParser(string $parserType): ParserInterface
    {
        if (!isset($this->parsers[$parserType])) {
            throw new ParserException("Parser {$parserType} not found");
        }

        return $this->parsers[$parserType];
    }
}
