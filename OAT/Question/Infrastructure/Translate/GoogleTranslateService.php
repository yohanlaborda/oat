<?php

namespace OAT\Question\Infrastructure\Translate;

use Exception;
use OAT\Question\Domain\Translate\TranslateService;
use Stichoza\GoogleTranslate\GoogleTranslate;

final class GoogleTranslateService implements TranslateService
{
    public function __construct(private string $source)
    {
    }

    public function translate(string $text, string $target): ?string
    {
        try {
            $translated = GoogleTranslate::trans($text, $target, $this->source);
        } catch (Exception) {
            $translated = null;
        }

        return $translated;
    }
}
