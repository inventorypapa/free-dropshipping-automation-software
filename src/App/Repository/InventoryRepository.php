<?php

namespace App\Repository;

use App\Entity\Inventory;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;

class InventoryRepository extends EntityRepository
{
    /*
    public function __construct(EntityManager $entityManager, ClassMetadata $class)
    {
        parent::__construct($entityManager, $class);
    }
*/
    public function createInventoryListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('i')
        ;
    }

    public function findAll()
    {
        return $this->findBy([]);
    }

    public function findByCode(string $code) :Inventory
    {
        return $this->findOneBy(['code'=>$code]);
    }

}