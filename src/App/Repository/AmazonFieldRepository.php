<?php

namespace App\Repository;

use App\Entity\AmazonField;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AmazonField|null find($id, $lockMode = null, $lockVersion = null)
 * @method AmazonField|null findOneBy(array $criteria, array $orderBy = null)
 * @method AmazonField[]    findAll()
 * @method AmazonField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmazonFieldRepository extends EntityRepository
{


    // /**
    //  * @return AmazonField[] Returns an array of AmazonField objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AmazonField
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
