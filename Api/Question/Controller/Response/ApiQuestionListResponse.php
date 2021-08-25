<?php

namespace Api\Question\Controller\Response;

use JsonSerializable;
use OAT\Question\Application\Response\QuestionListResponse;
use OAT\Question\Application\Response\QuestionResponse;

final class ApiQuestionListResponse implements JsonSerializable
{
    public function __construct(private QuestionListResponse $questionList)
    {
    }

    public function jsonSerialize()
    {
        return array_map(
            static fn (QuestionResponse $question) => new ApiQuestionResponse($question),
            $this->questionList->questions()
        );
    }
}
