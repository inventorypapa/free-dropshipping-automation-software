<?php

namespace App\Repository;

use App\Entity\Rma;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
/**
 * @method Rma|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rma|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rma[]    findAll()
 * @method Rma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RmaRepository extends EntityRepository
{

    public function createInventoryListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('i')
        ;
    }
    // /**
    //  * @return Rma[] Returns an array of Rma objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rma
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
