<?php

namespace App\Repository;

use App\Entity\OrderRouted;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderRouted|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderRouted|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderRouted[]    findAll()
 * @method OrderRouted[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRoutedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderRouted::class);
    }

    // /**
    //  * @return OrderRouted[] Returns an array of OrderRouted objects
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
    public function findOneBySomeField($value): ?OrderRouted
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
