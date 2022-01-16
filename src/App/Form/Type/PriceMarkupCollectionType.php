<?php

namespace App\Form\Type;

use App\Entity\PriceMarkup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Channel\Model\Channel;

class PriceMarkupCollectionType extends AbstractType
{
    private $channelRepository;

    public function __construct(RepositoryInterface $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('save', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'sylius.ui.save',])
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {

        $resolver->setDefaults([
            'entries' => $this->channelRepository->findAll(),
            'entry_type' => \App\Form\Type\PriceMarkupType::class,
            'entry_name' => function (Channel $channel) {
                return $channel->getCode(); 
            },

            'error_bubbling' => false,
            //'data_class' => \App\Entity\PriceMarkup::class,
        ]);
        
    }

    public function getParent(): string
    {
        return \Sylius\Bundle\ResourceBundle\Form\Type\FixedCollectionType::class;
    }

}
