<?php

namespace App\Form;

use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('pays')
            ->add('style'/* ,ChoiceType::class, [
                'choices' => ['Rap'=>"rap",'Rnb' =>'Rnb','rock'=>'rock', 'electro' =>'electro',
                                'raggae'=>'raggae'],
                'multiple' => false,
                'expanded' => true
            ] */)
            ->add('presentation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
