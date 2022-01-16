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

namespace App\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\FixedCollectionType;
use App\Repository\ProductInventoryRepository;
use App\Entity\Inventory;
use Symfony\Component\Form\AbstractType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProductInventoryCollectionType extends AbstractResourceType
{
    private ProductInventoryRepository $inventoryRepository;

    public function __construct(ProductInventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entries' => $this->inventoryRepository->findAll(),
            'entry_name' => function (Inventory $inventory) {
                return $inventory->getName();
            },
            'error_bubbling' => false,
        ]);
    }

    public function getParent(): string
    {
        return FixedCollectionType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'sylius_inventory_product_collection';
    }
}
