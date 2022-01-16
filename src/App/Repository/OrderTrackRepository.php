<?php

namespace App\Repository;

use App\Entity\OrderTrack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
/**
 * @method OrderTrack|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderTrack|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderTrack[]    findAll()
 * @method OrderTrack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderTrackRepository extends EntityRepository
{

    // /**
    //  * @return OrderTrack[] Returns an array of OrderTrack objects
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
    public function findOneBySomeField($value): ?OrderTrack
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
