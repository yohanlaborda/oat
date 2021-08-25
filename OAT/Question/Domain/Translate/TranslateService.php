<?php

namespace OAT\Question\Domain\Translate;

interface TranslateService
{
    public function translate(string $text, string $target): ?string;
}
