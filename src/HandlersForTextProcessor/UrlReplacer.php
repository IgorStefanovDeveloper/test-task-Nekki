<?php

namespace Igorstefanovdeveloper\Nekki\HandlersForTextProcessor;

class  UrlReplacer implements HandlerInterface
{
    /**
     * This function replace url to <a> teg
     * @param $text Text
     * @return string Text after replaced url to <a>
     */
    public static function handle($text): string
    {
        return preg_replace('/(https?:\/\/\S+)/', '<a href="$1">$1</a>', $text);
    }

    /**
     * Return name of this handle
     * @return string Name of this handle
     */
    public static function getHandleName(): string
    {
        return 'UrlReplacer';
    }
}
