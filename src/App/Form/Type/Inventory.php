<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use App\Repository\InventoryRepository;
use App\Repository\ProductInventoryRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use  Symfony\Component\Form\FormEvents;
use  Symfony\Component\Form\FormEvent;
final class Inventory extends AbstractResourceType
{
    private InventoryRepository $inventoryRepository;
    private ProductInventoryRepository $productInventoryRepository;

    public function __construct(
        string $dataClass,
        array $validationGroups,
        ?RepositoryInterface $inventoryRepository = null,
        ?RepositoryInterface $productInventoryRepository = null
    ) {
        parent::__construct($dataClass, $validationGroups);

        $this->inventoryRepository = $inventoryRepository;
        $this->productInventoryRepository = $productInventoryRepository;

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
                    
        $builder
            ->add('sku', TextType::class, [
                'label' => false,
                
            ])
            ->add('onHand', TextType::class, [
                'label' => false,
                
            ])
            ->add('cost', MoneyType::class, [
                'label' => false,
                'required' => false,
                'currency' => 'EUR',
                'divisor' => 1,
            ])
            ->add('shipping', MoneyType::class, [
                'label' => false,
                'required' => false,
                'currency' => 'EUR',
                'divisor' => 1,
            ])
            ->add('totalcost', MoneyType::class, [
                'label' => false,
                'required' => false,
                'currency' => 'EUR',
                'divisor' => 1,
            ]);
            
            $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options): void {
                if($event->getData() ==  null){
                }
            } );
            $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($options): void {
                $channelPricing = $event->getData();
                
                if($channelPricing && $channelPricing->getProductVariant()) {
                   // $channelPricing->getProductVariant()->getInventories()->clear();
                }
                if (!$channelPricing instanceof \App\Entity\ProductInventory ) {
                    //$event->setData(null);
                    return;
                }
                if(! $channelPricing->getProductId()){
                    //var_dump($channelPricing);exit;
                }
                if ($channelPricing->getCost() === null or $channelPricing->getShipping() === null) {
                    $event->setData(null);
                    if ($channelPricing->getId() !== null) {
                        $this->productInventoryRepository->remove($channelPricing);
                    }
                    return;
                }
            });
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver
            ->setDefined('name')
            //->setPropertyPath('name');
            //->setDefined('code')
            //->setAllowedTypes('name', ['string'])
            ->setDefaults([
                'label' => function (Options $options): string {
                    return $options['inventory']->getName();
                },
                'data_class' => \App\Entity\ProductInventory::class, // important, The form's view data is expected to be a "\App\Entity\Inventory", but it is a "App\Entity\ProductInventory".
                'mapped'=>true
            ])
        ;
    }
    public static function getExtendedTypes(): iterable
    {
        return [self::class];
    }
}