<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler;

class UserListHandler
{
    protected ParserRegistry $parserRegistry;

    public const string TYPE_JSON = 'json';
    public const string TYPE_CSV = 'csv';
    public const string TYPE_XML = 'xml';

    public function __construct(ParserRegistry $parserRegistry)
    {
        $this->parserRegistry = $parserRegistry;
    }

    public function run(string $data, string $parserType): array
    {
        $parser = $this->parserRegistry->getParser($parserType);

        return $parser->parse($data);
    }
}
