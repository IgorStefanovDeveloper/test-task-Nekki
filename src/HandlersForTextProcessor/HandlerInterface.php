<?php

namespace Igorstefanovdeveloper\Nekki\HandlersForTextProcessor;

interface HandlerInterface
{
    public static function handle(string $text): string;

    public static function getHandleName(): string;
}
