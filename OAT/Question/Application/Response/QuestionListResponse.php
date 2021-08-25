<?php

namespace OAT\Question\Application\Response;

use OAT\Question\Domain\Entity\Question;

final class QuestionListResponse
{
    /**
     * @param Question[] $questions
     */
    public function __construct(private array $questions)
    {
    }

    /**
     * @return QuestionResponse[]
     */
    public function questions(): array
    {
        return array_map(
            static fn (Question $question) => new QuestionResponse($question),
            $this->questions
        );
    }
}
