<?php

namespace OAT\Question\Application\Service;

use OAT\Question\Application\Request\CreateQuestionRequest;
use OAT\Question\Application\Response\QuestionResponse;
use OAT\Question\Domain\Collection\Choices;
use OAT\Question\Domain\Factory\QuestionFactory;
use OAT\Question\Domain\Repository\QuestionRepository;
use OAT\Question\Domain\ValueObject\CreatedAt;
use OAT\Question\Domain\ValueObject\Text;

final class CreateQuestionService
{
    public function __construct(
        private QuestionRepository $repository
    ) {
    }

    public function create(CreateQuestionRequest $request): QuestionResponse
    {
        $question = QuestionFactory::create(
            id: $this->repository->nextId(),
            text: Text::create($request->text()),
            createdAt: CreatedAt::create($request->createdAt()),
            choices: Choices::createFromArray($request->choices())
        );

        $this->repository->add($question);

        return new QuestionResponse($question);
    }
}
