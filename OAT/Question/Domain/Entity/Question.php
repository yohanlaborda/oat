<?php

namespace OAT\Question\Domain\Entity;

use OAT\Question\Domain\Collection\Choices;
use OAT\Question\Domain\ValueObject\CreatedAt;
use OAT\Question\Domain\ValueObject\Id;
use OAT\Question\Domain\ValueObject\Text;

final class Question
{
    public function __construct(
        private Id $id,
        private Text $text,
        private CreatedAt $createdAt,
        private Choices $choices
    ) {
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function text(): Text
    {
        return $this->text;
    }

    public function createdAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function choices(): Choices
    {
        return $this->choices;
    }
}
