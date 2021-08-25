<?php

namespace Api\Question\Controller\Response;

use JsonSerializable;
use OAT\Question\Application\Response\ChoiceResponse;
use OAT\Question\Application\Response\QuestionResponse;

final class ApiQuestionResponse implements JsonSerializable
{
    public function __construct(private QuestionResponse $question)
    {
    }

    public function jsonSerialize()
    {
        $choices = array_map(
            static fn (ChoiceResponse $choice) => new ApiChoiceResponse($choice),
            $this->question->choices()
        );

        return [
            'text' => $this->question->text(),
            'createdAt' => $this->question->createdAt()->format('Y-m-d H:i:s'),
            'choices' => $choices,
        ];
    }
}
