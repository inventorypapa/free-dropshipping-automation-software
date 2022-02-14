<?php

namespace App\Repository;

use App\Entity\EbayField;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EbayFields|null find($id, $lockMode = null, $lockVersion = null)
 * @method EbayFields|null findOneBy(array $criteria, array $orderBy = null)
 * @method EbayFields[]    findAll()
 * @method EbayFields[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EbayFieldRepository extends EntityRepository
{
    /*
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EbayFields::class);
    }
    */
    // /**
    //  * @return EbayFields[] Returns an array of EbayFields objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EbayFields
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
