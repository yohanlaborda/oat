<?php

namespace OAT\Question\Domain\ValueObject;

use InvalidArgumentException;
use Stringable;

final class Text implements Stringable
{
    private const MAXIMUM_CHARACTERS = 255;
    private string $text;

    private function __construct(string $text)
    {
        $this->setText($text);
    }

    public static function create(string $text): self
    {
        return new self($text);
    }

    private function setText(string $text): void
    {
        if (empty($text)) {
            throw new InvalidArgumentException('Text cannot be empty.');
        }

        if (strlen($text) > self::MAXIMUM_CHARACTERS) {
            throw new InvalidArgumentException('Text cannot be longer than 255 characters.');
        }

        $this->text = $text;
    }

    public function value(): string
    {
        return $this->text;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
