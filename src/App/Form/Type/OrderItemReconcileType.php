<?php

namespace App\Form\Type;

use App\Entity\OrderItemReconcile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\DataMapperInterface;
class OrderItemReconcileType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orderItemId', \Symfony\Component\Form\Extension\Core\Type\HiddenType::class,)
            ->add('real_cost', MoneyType::class, [
                'label' => false,
                'required' => false,
                'currency' => 'EUR',
                'divisor' => 100,
            ])
            ->add('real_shipping', MoneyType::class, [
                'label' => false,   
                'required' => false,
                'currency' => 'EUR',
                'divisor' => 100,
            ])
            ->add('save', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'sylius.ui.update',])
        ;
    }
    public function mapDataToForms($viewData, iterable $forms)
    {
        exit('s');
        if (null === $viewData) {
            return;
        }

        $forms = iterator_to_array($forms);
        $forms['email']->setData($viewData->toString());
    }

    public function mapFormsToData(iterable $forms, &$viewData)
    {
        exit('s');
        $forms = iterator_to_array($forms);
        $viewData = new Email($forms['email']->getData());
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrderItemReconcile::class,
        ]);
    }
}
