<?php

namespace OAT\Question\Infrastructure\Persistence\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use OAT\Question\Domain\Entity\Question;
use OAT\Question\Domain\Repository\QuestionRepository;
use OAT\Question\Domain\ValueObject\Id;

/**
 * @template-extends ServiceEntityRepository<Question>
 */
final class DoctrineQuestionRepository extends ServiceEntityRepository implements QuestionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function nextId(): Id
    {
        return Id::createNew();
    }

    public function getAll(): array
    {
        return $this->findAll();
    }

    public function add(Question $question): void
    {
        $this->getEntityManager()->persist($question);
        $this->getEntityManager()->flush();
    }
}
