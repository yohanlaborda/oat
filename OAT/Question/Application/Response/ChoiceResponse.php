<?php

namespace OAT\Question\Application\Response;

use OAT\Question\Domain\ValueObject\Choice;

final class ChoiceResponse
{
    public function __construct(private Choice $choice)
    {
    }

    public function text(): string
    {
        return $this->choice->text()->value();
    }
}
