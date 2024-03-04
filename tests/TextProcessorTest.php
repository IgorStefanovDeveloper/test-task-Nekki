<?php

use Igorstefanovdeveloper\Nekki\HandlersForTextProcessor\ImgTagRemover;
use Igorstefanovdeveloper\Nekki\HandlersForTextProcessor\ProfanityFilter;
use Igorstefanovdeveloper\Nekki\HandlersForTextProcessor\UrlReplacer;
use Igorstefanovdeveloper\Nekki\TextProcessor;
use PHPUnit\Framework\TestCase;

class TextProcessorTest extends TestCase
{
    public function testRemoveImgTags()
    {
        $textProcessor = new TextProcessor();

        $textProcessor->addHandler(new ProfanityFilter());
        $textProcessor->addHandler(new ImgTagRemover());
        $textProcessor->addHandler(new UrlReplacer());

        // Текст с тегами <img>
        $textWithImgTags = "<p>This is a text with an <img src='image.jpg'> and another <img src='image2.jpg'></p>";
        // Ожидаемый результат (текст без тегов <img>)
        $expectedResult = "<p>This is a text with an  and another </p>";

        // Убедимся, что текст с тегами <img> обрабатывается правильно
        $this->assertEquals($expectedResult, $textProcessor->process($textWithImgTags));
    }

    public function testRemoveImgTagsNoImgTags()
    {
        $textProcessor = new TextProcessor();

        $textProcessor->addHandler(new ProfanityFilter());
        $textProcessor->addHandler(new ImgTagRemover());
        $textProcessor->addHandler(new UrlReplacer());

        // Текст без тегов <img>
        $textWithoutImgTags = "<p>This is a text without img tags</p>";

        // Ожидаемый результат должен быть таким же, как и входной текст, так как тегов <img> нет
        $this->assertEquals($textWithoutImgTags, $textProcessor->process($textWithoutImgTags));
    }

    public function testProfanityFilter() {
        $textProcessor = new TextProcessor();

        $textProcessor->addHandler(new ProfanityFilter());
        $textProcessor->addHandler(new ImgTagRemover());
        $textProcessor->addHandler(new UrlReplacer());

        // Тест с матерным словом
        $textWithProfanity = "This is a text with a bad word: damn";
        $filteredText = $textProcessor->process($textWithProfanity);
        $this->assertEquals("This is a text with a bad word: ...", $filteredText);

        // Тест без матерных слов
        $textWithoutProfanity = "This is a clean text";
        $filteredText = $textProcessor->process($textWithoutProfanity);
        $this->assertEquals($textWithoutProfanity, $filteredText);
    }

    public function testUrlReplacer() {
        $textProcessor = new TextProcessor();

        $textProcessor->addHandler(new ProfanityFilter());
        $textProcessor->addHandler(new ImgTagRemover());
        $textProcessor->addHandler(new UrlReplacer());

        // Тест с URL
        $textWithUrl = "This is a text with a URL: https://example.com";
        $replacedText = $textProcessor->process($textWithUrl);
        $this->assertEquals("This is a text with a URL: <a href=\"https://example.com\">https://example.com</a>", $replacedText);

        // Тест без URL
        $textWithoutUrl = "This is a text without URL";
        $replacedText = $textProcessor->process($textWithoutUrl);
        $this->assertEquals($textWithoutUrl, $replacedText);
    }
}
