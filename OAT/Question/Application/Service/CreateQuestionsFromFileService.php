<?php

namespace OAT\Question\Application\Service;

use OAT\Question\Application\Response\QuestionListResponse;
use OAT\Question\Domain\File\FileReader;
use OAT\Question\Domain\Repository\QuestionRepository;

final class CreateQuestionsFromFileService
{
    public function __construct(
        private FileReader $fileReader,
        private QuestionRepository $repository
    ) {
    }

    public function createFromFile(string $path): QuestionListResponse
    {
        $questions = $this->fileReader->read($path);
        foreach ($questions as $question) {
            $this->repository->add($question);
        }

        return new QuestionListResponse($questions);
    }
}
