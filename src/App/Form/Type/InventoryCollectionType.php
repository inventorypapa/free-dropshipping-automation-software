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

use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\FixedCollectionType;
use App\Repository\InventoryRepository;
use Symfony\Component\Form\AbstractType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\DataTransformerInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

final class InventoryCollectionType extends AbstractResourceType
{
    private InventoryRepository $inventoryRepository;
    private DataTransformerInterface $productsToProductAssociationsTransformer;

    public function __construct(InventoryRepository $inventoryRepository , DataTransformerInterface  $productInventoriesToInventoriesTransformer )
    {
        $this->inventoryRepository = $inventoryRepository;
        $this->productInventoriesToInventoriesTransformer = $productInventoriesToInventoriesTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer($this->productInventoriesToInventoriesTransformer);
        //var_dump($builder->getForm()->getData());exit;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entries' => $this->inventoryRepository->findAll(),
            'entry_type' => TextType::class,
            'entry_name' => function (\App\Entity\Inventory $inventory) {
                return $inventory->getCode(); 
            },
            'error_bubbling' => false,
            'data_class'=>null, // important, otheriwse will complain class not App\Entity\Inventory
        ]);
    }
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        //var_dump($form->getViewData());exit;
    }
    public function getParent(): string
    {
        return FixedCollectionType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'sylius_inventory_collection';
    }
}
