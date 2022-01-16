<?php

namespace App\Repository;

use App\Entity\OrderItemReconcile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderItemReconcile|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderItemReconcile|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderItemReconcile[]    findAll()
 * @method OrderItemReconcile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderItemReconcileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderItemReconcile::class);
    }

    // /**
    //  * @return OrderItemReconcile[] Returns an array of OrderItemReconcile objects
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
    public function findOneBySomeField($value): ?OrderItemReconcile
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
