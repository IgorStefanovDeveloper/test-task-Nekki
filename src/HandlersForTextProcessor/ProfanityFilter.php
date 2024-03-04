<?php

namespace Igorstefanovdeveloper\Nekki\HandlersForTextProcessor;

class  ProfanityFilter implements HandlerInterface
{
    const PROFANITY_WORDS = ['damn', 'word2'];

    const REPLACE = '...';

    /**
     * This function removes profanity words from text
     * @param $text Text
     * @return string Text after removing the profanity words
     */
    public static function handle($text): string
    {
        return str_ireplace(self::PROFANITY_WORDS, self::REPLACE, $text);
    }

    /**
     * Return name of this handle
     * @return string Name of this handle
     */
    public static function getHandleName(): string
    {
        return 'ProfanityFilter';
    }
}
