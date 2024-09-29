<?php

declare(strict_types=1);

namespace Suddhah\UserListHandler\Factories;

use Suddhah\UserListHandler\Contracts\ParserInterface;
use Suddhah\UserListHandler\ParserRegistry;
use Suddhah\UserListHandler\Parsers\{CsvParser, JsonParser, XmlParser};

class ParserFactory
{
    protected static array $extraParsers = [];

    public static function registerParser(string $type, ParserInterface $parser): void
    {
        self::$extraParsers[$type] = $parser;
    }

    public static function createParserRegistry(): ParserRegistry
    {
        $parserRegistry = new ParserRegistry();

        self::registerDefaultParsers($parserRegistry);

        foreach (self::$extraParsers as $type => $parser) {
            $parserRegistry->register($type, $parser);
        }

        return $parserRegistry;
    }

    public static function registerDefaultParsers(ParserRegistry $parserRegistry): void
    {
        $parserRegistry->register('json', new JsonParser());
        $parserRegistry->register('csv', new CsvParser());
        $parserRegistry->register('xml', new XmlParser());
    }
}
