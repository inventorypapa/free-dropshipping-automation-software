<?php

namespace App\Form\Type;

use App\Entity\Track;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TrackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, ['constraints' => array(
                new \Symfony\Component\Validator\Constraints\NotBlank(),
            )])
            ->add('url',TextType::class,  ['constraints' => array(
                new \Symfony\Component\Validator\Constraints\NotBlank(),
            )])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Track::class,
            'attr'=>array()
        ]);
    }
}
