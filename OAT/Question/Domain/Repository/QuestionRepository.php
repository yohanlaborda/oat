<?php

namespace OAT\Question\Domain\Repository;

use OAT\Question\Domain\Entity\Question;
use OAT\Question\Domain\ValueObject\Id;

interface QuestionRepository
{
    public function nextId(): Id;

    /**
     * @return Question[]
     */
    public function getAll(): array;

    public function add(Question $question): void;
}
