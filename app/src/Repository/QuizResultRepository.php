<?php

namespace App\Repository;

use App\Entity\QuizResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizResult>
 */
class QuizResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizResult::class);
    }

    public function save(QuizResult $quizResult, bool $flush = false): void
    {
        $this->getEntityManager()->persist($quizResult);

        if($flush === true){
            $this->getEntityManager()->flush();
        }
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

    public function getByUserId(string $userId): array
    {
        return $this->createQueryBuilder('q')
            ->where('q.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }
}
