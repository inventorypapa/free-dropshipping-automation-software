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
use App\Repository\EbayFieldRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use  Symfony\Component\Form\FormEvents;
use  Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
final class EbayField extends AbstractResourceType
{
    private EbayFieldRepository $ebayFieldRepository;

    public function __construct(
        string $dataClass,
        array $validationGroups,
        ?RepositoryInterface $ebayFieldRepository = null
    ) {
        parent::__construct($dataClass, $validationGroups);

        $this->ebayFieldRepository = $ebayFieldRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
                    
        $builder
            ->add('ebayAccount', TextType::class, [
                'label' => false,
                'required' => false,
               // 'disabled' => true, // cant be disabled, otherwise the ebay_account will be empty while adding new record
               /*
               An exception occurred while executing 'INSERT INTO ebayfield (ebay_account, ebay_item_id, ebay_brand_name, product_id, variant_id) VALUES (?, ?, ?, ?, ?)' with params [null, "dd", "dd", null, null]:
                */
            ])
            ->add('ebayItemId', null, [
                'label' => false,
                'required' => false,
                'empty_data' => ''
            ])
            ->add('ebayBrandName', null, [
                'label' => false,
                'required' => false,
                'empty_data' => ''
            ])
            ->add('productId', HiddenType::class, [
                'label' => false,
            ])
            ->add('variantId', HiddenType::class, [
                'label' => false,
            ]);
            $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options): void {
                if($event->getData() ==  null){
                }
            });
            $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($options): void {
                $data = $event->getData();
                //var_dump($data);
                if($data && $data->getProductVariant()) {
                   // $data->getProductVariant()->getInventories()->clear();
                }
                if (!$data instanceof \App\Entity\EbayField ) {
                    //$event->setData(null);
                    return;
                }
                
                if ($data->getEbayItemId() == null or $data->getEbayBrandName() == null) {
                    $event->setData(null);
                    //var_dump($data->getId());exit;
                    if ($data->getId() !== null) {
                        $this->ebayFieldRepository->remove($data);
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
            ->setDefaults([
                'label' => function (Options $options): string {
                    //return 'ebayAccount1';
                },
                'data_class' => \App\Entity\EbayField::class, 
                'mapped'=>true
            ])
        ;
    }
    public static function getExtendedTypes(): iterable
    {
        return [self::class];
    }
}