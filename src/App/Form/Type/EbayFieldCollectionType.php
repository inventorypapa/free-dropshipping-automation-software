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
use App\Repository\EbayFieldRepository;
use Symfony\Component\Form\AbstractType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\DataTransformerInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

final class EbayFieldCollectionType extends AbstractResourceType
{
    private EbayFieldRepository $ebayFieldRepository;
    private DataTransformerInterface $ebayFieldsTransformer;

    public function __construct(EbayFieldRepository $ebayFieldRepository , DataTransformerInterface  $ebayFieldsTransformer )
    {
        $this->ebayFieldRepository = $ebayFieldRepository;
        $this->ebayFieldsTransformer = $ebayFieldsTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer($this->ebayFieldsTransformer);
        //var_dump($builder->getForm()->getData());exit;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $accoutns = [];
        
        //todo , change account names
        
        $resolver->setDefaults([
            'entries' => ['ebayAccount1','ebayAccount2'],
            'entry_type' => TextType::class,
            'entry_name' => function (string $ebayAccount) {
                return $ebayAccount; 
            },
            'error_bubbling' => false,
            //'data_class'=>null, // important, otheriwse will complain class not App\Entity\EbayField
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
