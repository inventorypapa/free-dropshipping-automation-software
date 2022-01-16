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
final class OrderRouted extends AbstractResourceType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
                    
        $builder
        ->add('save', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'sylius.ui.route_now',])
        ->add('inventoryId', \Symfony\Component\Form\Extension\Core\Type\HiddenType::class,)
        ->add('orderItemId', \Symfony\Component\Form\Extension\Core\Type\HiddenType::class,);
        /*
            $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($options): void {
                $channelPricing = $event->getData();
                if($channelPricing && $channelPricing->getProductVariant()) {
                   // $channelPricing->getProductVariant()->getInventories()->clear();
                }

                if (!$channelPricing instanceof \App\Entity\ProductInventory ) {
                    //$event->setData(null);
                    return;
                }

                if ($channelPricing->getCost() === null or $channelPricing->getShipping() === null) {
                    
                    $event->setData(null);
   
                    if ($channelPricing->getId() !== null) {
                        $this->productInventoryRepository->remove($channelPricing);
                    }
                    return;
                }
    
                //$event->setData($channelPricing);
            });
            */

        //var_dump($builder->getForm()->all()['name']->getViewData());exit;
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
                'data_class' => \App\Entity\OrderRouted::class, 
                'mapped'=>true
            ])
        ;
        
    }
    public static function getExtendedTypes(): iterable
    {
        return [self::class];
    }
}