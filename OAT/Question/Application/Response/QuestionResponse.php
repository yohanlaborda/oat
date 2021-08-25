<?php

namespace OAT\Question\Application\Response;

use DateTimeImmutable;
use OAT\Question\Domain\Entity\Question;
use OAT\Question\Domain\ValueObject\Choice;

final class QuestionResponse
{
    public function __construct(private Question $question)
    {
    }

    public function text(): string
    {
        return $this->question->text()->value();
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->question->createdAt()->value();
    }

    /**
     * @return ChoiceResponse[]
     */
    public function choices(): array
    {
        return array_map(
            static fn (Choice $choice) => new ChoiceResponse($choice),
            $this->question->choices()->getAll()
        );
    }
}
