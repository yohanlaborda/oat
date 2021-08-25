<?php

namespace OAT\Question\Domain\Factory;

use OAT\Question\Domain\Collection\Choices;
use OAT\Question\Domain\Entity\Question;
use OAT\Question\Domain\ValueObject\CreatedAt;
use OAT\Question\Domain\ValueObject\Id;
use OAT\Question\Domain\ValueObject\Text;

final class QuestionFactory
{
    public static function create(
        Id $id,
        Text $text,
        CreatedAt $createdAt,
        Choices $choices
    ): Question {
        return new Question(
            id: $id,
            text: $text,
            createdAt: $createdAt,
            choices: $choices
        );
    }
}
