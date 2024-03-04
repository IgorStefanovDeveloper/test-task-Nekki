<?php

namespace Igorstefanovdeveloper\Nekki\HandlersForTextProcessor;

class  ImgTagRemover implements HandlerInterface
{
    /**
     * This function removes img tag from text
     * @param $text Text
     * @return string Text after removing the img tag
     */
    public static function handle($text): string
    {
        return preg_replace('/<img[^>]*>/', '', $text);
    }

    /**
     * Return name of this handle
     * @return string Name of this handle
     */
    public static function getHandleName(): string
    {
        return 'ImgTagRemover';
    }
}
