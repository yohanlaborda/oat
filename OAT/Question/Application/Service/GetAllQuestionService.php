<?php

namespace OAT\Question\Application\Service;

use OAT\Question\Application\Response\QuestionListResponse;
use OAT\Question\Domain\Entity\Question;
use OAT\Question\Domain\Repository\QuestionRepository;
use OAT\Question\Domain\Service\TranslateQuestionService;

final class GetAllQuestionService
{
    public function __construct(
        private QuestionRepository $repository,
        private TranslateQuestionService $translateQuestionService
    ) {
    }

    public function getAll(string $lang): QuestionListResponse
    {
        $questions = $this->repository->getAll();
        if (empty($lang)) {
            return new QuestionListResponse($questions);
        }

        return new QuestionListResponse(
            $this->translate($questions, $lang)
        );
    }

    /**
     * @param Question[] $questions
     *
     * @return Question[]
     */
    private function translate(array $questions, string $lang): array
    {
        $translatedQuestions = [];
        foreach ($questions as $question) {
            $translatedQuestions[] = $this->translateQuestionService->translate($question, $lang);
        }

        return $translatedQuestions;
    }
}
