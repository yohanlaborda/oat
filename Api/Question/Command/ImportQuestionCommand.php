<?php

namespace Api\Question\Command;

use Exception;
use OAT\Question\Application\Service\CreateQuestionsFromFileService;
use OAT\Question\Infrastructure\File\CsvFileReader;
use OAT\Question\Infrastructure\Persistence\Repository\DoctrineQuestionRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ImportQuestionCommand extends Command
{
    private CsvFileReader $csvFileReader;
    private DoctrineQuestionRepository $repository;

    public function __construct(CsvFileReader $csvFileReader, DoctrineQuestionRepository $repository)
    {
        parent::__construct('app:import:csv');

        $this->csvFileReader = $csvFileReader;
        $this->repository = $repository;
    }

    protected function configure(): void
    {
        $this->setDescription('Import quetions from csv');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $createQuestionsFromFileService = new CreateQuestionsFromFileService(
            $this->csvFileReader,
            $this->repository,
        );

        $symfonyInputOutput = new SymfonyStyle($input, $output);
        $symfonyInputOutput->title('Import quetions from csv');

        try {
            $questionListResponse = $createQuestionsFromFileService->createFromFile(__DIR__.'/../debug/questions.csv');
        } catch (Exception $exception) {
            $symfonyInputOutput->error($exception->getMessage());

            return Command::FAILURE;
        }

        $symfonyInputOutput->success('Total imported: '.count($questionListResponse->questions()));

        return Command::SUCCESS;
    }
}
