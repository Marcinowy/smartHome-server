<?php

namespace App\Repository;

use App\Entity\Okna;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Okna|null find($id, $lockMode = null, $lockVersion = null)
 * @method Okna|null findOneBy(array $criteria, array $orderBy = null)
 * @method Okna[]    findAll()
 * @method Okna[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OknaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Okna::class);
    }

    // /**
    //  * @return Okna[] Returns an array of Okna objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Okna
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
