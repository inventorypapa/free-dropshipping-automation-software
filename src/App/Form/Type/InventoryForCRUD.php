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
final class InventoryForCRUD extends AbstractResourceType
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
            ->add('code', TextType::class, [
                
            ])
            ->add('name', TextType::class, [
            ]);
            
            $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options): void {
                if($event->getData() ==  null){
                }
            } );
            $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($options): void {
                
    
                //$event->setData($channelPricing);
            });

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
                'mapped'=>true
            ])
        ;
        
    }
    public static function getExtendedTypes(): iterable
    {
        return [self::class];
    }
}