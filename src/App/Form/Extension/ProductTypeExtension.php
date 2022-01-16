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

namespace App\Form\Extension;

use Symfony\Component\Form\FormEvents ;
use Symfony\Component\Form\FormEvent;
use App\Form\Type\Inventory;
use App\Form\Type\InventoryCollectionType;
use App\Form\Type\ProductInventoryCollectionType;
use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractTypeExtension;

final class ProductTypeExtension extends AbstractTypeExtension
{
    private ?RepositoryInterface $inventoryRepository;

    public function __construct(?RepositoryInterface $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
            $productVariant = $event->getData();
        
            $event->getForm()/*->add('product_inventories', ProductInventoryCollectionType::class, [
                'entry_type' => App\Form\Type\ProductInventory::class,//todo : should be ProductInventory
                'entry_options' => function (\App\Entity\ProductInventory $inventory) use ($productVariant) {
                    return [
                        'inventory' => $inventory,
                        'required' => false,
                    ];
                },
                'label' => 'sylius.form.product_inventory',
                'mapped' => false
            ])*/->add('inventories', InventoryCollectionType::class, [
                'entry_type' => \App\Form\Type\Inventory::class,//todo : should be ProductInventory
                'entry_options' => function (\App\Entity\Inventory $inventory) use ($productVariant) {
                    return [
                        'name' => $inventory->getCode(),
                        'required' => false,
                    ];
                },
                'label' => 'sylius.form.inventory',
                'mapped' => true,
            ]);
            
        });
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}