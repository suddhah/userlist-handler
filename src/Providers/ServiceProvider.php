<?php

namespace Suddhah\UserListHandler\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Suddhah\UserListHandler\Factories\ParserFactory;
use Suddhah\UserListHandler\UserListHandler;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        if (file_exists($file = __DIR__.'/../helpers.php')) {
            require $file;
        }
    }

    public function register(): void
    {
        $this->app->bind(UserListHandler::class, function ($app) {
            $parserRegistry = ParserFactory::createParserRegistry();
            return new UserListHandler($parserRegistry);
        });
    }
}
