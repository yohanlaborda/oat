<?php

namespace Api\Question\Controller;

use Api\Question\Controller\Response\ApiQuestionListResponse;
use OAT\Question\Application\Service\GetAllQuestionService;
use OAT\Question\Domain\Service\TranslateQuestionService;
use OAT\Question\Infrastructure\Persistence\Repository\DoctrineQuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/questions', name: 'questions_')]
final class GetAllQuestionController extends AbstractController
{
    public function __construct(
        private DoctrineQuestionRepository $repository,
        private TranslateQuestionService $translateQuestionService
    ) {
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function getAll(Request $request): JsonResponse
    {
        $getAllQuestionService = new GetAllQuestionService(
            $this->repository,
            $this->translateQuestionService
        );

        $questionListResponse = $getAllQuestionService->getAll((string) $request->get('lang'));

        return new JsonResponse(
            new ApiQuestionListResponse($questionListResponse)
        );
    }
}
