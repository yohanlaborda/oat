<?php

namespace Api\Question\Controller;

use Api\Question\Controller\Response\ApiQuestionResponse;
use Api\Symfony\Service\RequestJsonService;
use Exception;
use OAT\Question\Application\Request\CreateQuestionRequest;
use OAT\Question\Application\Service\CreateQuestionService;
use OAT\Question\Infrastructure\Persistence\Repository\DoctrineQuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/questions', name: 'questions_')]
final class CreateQuestionController extends AbstractController
{
    public function __construct(
        private DoctrineQuestionRepository $repository,
        private RequestJsonService $requestJsonService
    ) {
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $createQuestionService = new CreateQuestionService($this->repository);
        $requestArray = $this->requestJsonService->requestToArray($request);

        try {
            $questionResponse = $createQuestionService->create(
                CreateQuestionRequest::createFromArray($requestArray)
            );
        } catch (Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(
            new ApiQuestionResponse($questionResponse),
            Response::HTTP_CREATED
        );
    }
}
