<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Product\Model\ProductAssociationInterface;
use Sylius\Component\Product\Model\ProductAssociationTypeInterface;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Product\Repository\ProductRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\DataTransformerInterface;

final class ProductInventoriesToInventoriesTransformer implements DataTransformerInterface
{

    /**
     * @var Collection|ProductAssociationInterface[]
     *
     * @psalm-var Collection<array-key, ProductAssociationInterface>
     */
    private ?Collection $productAssociations = null;
    
    private RepositoryInterface $inventoryRepository;

    public function __construct(
        RepositoryInterface $inventoryRepository       
    ) {
        $this->inventoryRepository = $inventoryRepository;
    }

    public function transform($productAssociations)
    {
        //var_dump($productAssociations->first()->getCost());exit;
        $this->setInventories($productAssociations);
        if (null === $productAssociations) {
            return '';
        }
        $values = [];
        
        foreach($productAssociations as $k => $v){
            $values[$v->getCode()] = $v;
        }
        return $values;
    }

    public function reverseTransform($values): ?Collection
    {
        //var_dump($values);exit;
        $values = array_filter($values, function($v){return $v ;});
       $ret = new ArrayCollection();
        foreach($values as $k => $v){
            if($v instanceof  \App\Entity\ProductInventory){
                if($v->getCost() and $v->getShipping()){

                    $inv = $this->inventoryRepository->findByCode($k);
                    $v->setInventory($inv); // needed for add new ProductInventory
                    $ret->add($v);
                }
            }
        }
        return $ret;
    }

    private function getCodesAsStringFromProducts(Collection $products): ?string
    {
        if ($products->isEmpty()) {
            return null;
        }

        $codes = [];

        /** @var ProductInterface $product */
        foreach ($products as $product) {
            $codes[] = $product->getCode();
        }
        //var_dump($codes);exit;
        return implode(',', $codes);
    }

    private function getProductAssociationByTypeCode(string $productAssociationTypeCode): ProductAssociationInterface
    {
        foreach ($this->productAssociations as $productAssociation) {
            if ($productAssociationTypeCode === $productAssociation->getType()->getCode()) {
                return $productAssociation;
            }
        }

        /** @var ProductAssociationTypeInterface $productAssociationType */
        $productAssociationType = $this->productAssociationTypeRepository->findOneBy([
            'code' => $productAssociationTypeCode,
        ]);

        /** @var ProductAssociationInterface $productAssociation */
        $productAssociation = $this->productAssociationFactory->createNew();
        $productAssociation->setType($productAssociationType);

        return $productAssociation;
    }

    private function setAssociatedProductsByProductCodes(
        ProductAssociationInterface $productAssociation,
        string $productCodes
    ): void {
        $products = $this->productRepository->findBy(['code' => explode(',', $productCodes)]);

        $productAssociation->clearAssociatedProducts();
        foreach ($products as $product) {
            $productAssociation->addAssociatedProduct($product);
        }
    }

    private function setInventories($productAssociations): void
    {
        //var_dump($productAssociations);exit;
        $this->productAssociations = $productAssociations;
    }
}
