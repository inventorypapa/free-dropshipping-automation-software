<?php

namespace App\Repository;

use App\Entity\PriceMarkup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
/**
 * @method PriceMarkup|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceMarkup|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceMarkup[]    findAll()
 * @method PriceMarkup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceMarkupRepository extends EntityRepository
{

    // /**
    //  * @return PriceMarkup[] Returns an array of PriceMarkup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PriceMarkup
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
