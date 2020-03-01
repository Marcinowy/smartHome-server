<?php

namespace App\Repository;

use App\Entity\IOTTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IOTTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method IOTTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method IOTTypes[]    findAll()
 * @method IOTTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IOTTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IOTTypes::class);
    }

    // /**
    //  * @return IOTTypes[] Returns an array of IOTTypes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IOTTypes
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
