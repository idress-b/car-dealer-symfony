<?php

namespace App\Form;

use App\Classes\CarProvider;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;


class AnnoncesType extends AbstractType
{



  

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          
            ->add('title')
            ->add('subtitle')
            ->add('description')
            ->add('price')
            ->add('carburant');
    }
           

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
            'csrf_protection' => false
        ]);
    }
}
