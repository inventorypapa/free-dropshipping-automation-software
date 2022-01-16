<?php

namespace App\Form\Type;

use App\Entity\PriceMarkup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Channel\Model\Channel;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class PriceMarkupType extends AbstractType
{
    private $channelRepository;

    public function __construct(RepositoryInterface $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('formula', TextType::class,['label' => false])
            ->add('channelId', HiddenType::class, ['label' => false] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entries' => $this->channelRepository->findAll(),
            'entry_type' => TextType::class,
            'entry_name' => function (Channel $channel) {
                return $channel->getCode(); 
            },
            'error_bubbling' => false,
            
            //'data_class' => \App\Entity\PriceMarkup::class,
        ]);
    }
}
