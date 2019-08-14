<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Artist;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('date_debut')
            ->add('date_fin')
            ->add('lieu')
            ->add('ville')
            ->add('description')
            ->add('prix')
            ->add('artist_id', EntityType::class, [
                // looks for choices from this entity
                'class' => Artist::class,
                'choice_label' => 'nom'
            ]
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
