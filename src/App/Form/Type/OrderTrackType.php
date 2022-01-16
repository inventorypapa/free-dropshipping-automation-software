<?php

namespace App\Form\Type;

use App\Entity\OrderTrack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\TrackRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents ;
use Symfony\Component\Form\FormEvent;
class OrderTrackType extends AbstractResourceType
{
    private TrackRepository $trackRepository;

    public function __construct(
        TrackRepository $trackRepository = null
    ) {
        $this->trackRepository = $trackRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $trackRepository = $this->trackRepository ;
        

        $builder
            ->add('orderItemId', \Symfony\Component\Form\Extension\Core\Type\HiddenType::class,)
            
            ->add('trackNum')
            ->add('save', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'sylius.ui.update',])
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        //var_dump($form->getViewData());exit;
            //var_dump($options);exit;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrderTrack::class,
        ]);
    }
}
