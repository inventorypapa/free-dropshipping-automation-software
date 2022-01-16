<?php

namespace App\Repository;

use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductVariantRepository as BaseProductVariantRepository;

class ProductVariantRepository extends BaseProductVariantRepository
{
    public function findAllByOnHand(int $limit = 8): array
    {
        return $this->createQueryBuilder('o')
            ->addSelect('variant')
            ->addSelect('translation')
            ->leftJoin('o.variants', 'variant')
            ->leftJoin('o.translations', 'translation')
            ->addOrderBy('variant.onHand', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }
}