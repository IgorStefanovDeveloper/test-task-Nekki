<?php

namespace Igorstefanovdeveloper\Nekki;

use Igorstefanovdeveloper\Nekki\HandlersForTextProcessor\HandlerInterface;

class TextProcessor
{
    private array $handlers = [];

    /**
     * Add handle to collection
     * @param HandlerInterface $handler handle
     * @return void
     */
    public function addHandler(HandlerInterface $handler): void
    {
        $this->handlers[] = $handler;
    }

    /**
     * Validate text use current handlers
     * @param $text
     * @return string
     */
    public function process($text): string
    {
        foreach ($this->handlers as $handler) {
            $text = $handler::handle($text);
        }

        return $text;
    }
}
