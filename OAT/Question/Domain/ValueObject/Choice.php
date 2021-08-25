<?php

namespace OAT\Question\Domain\ValueObject;

use Stringable;

final class Choice implements Stringable
{
    private function __construct(
        private Text $text
    ) {
    }

    public static function createFromString(string $text): Choice
    {
        return self::create(
            Text::create($text)
        );
    }

    public static function create(Text $text): Choice
    {
        return new self(
            text: $text
        );
    }

    public function text(): Text
    {
        return $this->text;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string) $this->text;
    }
}
