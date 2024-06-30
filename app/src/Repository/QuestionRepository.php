<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Question>
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function save(Question $question, bool $flush = false): void
    {
        $this->getEntityManager()->persist($question);

        if($flush === true){
            $this->getEntityManager()->flush();
        }
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

    public function getAll(int $limit): array
    {
        return $this->createQueryBuilder('q')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
