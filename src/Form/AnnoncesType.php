<?php

namespace App\Form;

use App\Entity\Annonces;
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
            ->add('annee')
            ->add('mec')
            ->add('carburant')
            ->add('gearBox')
            ->add('type')
            ->add('portes')
            ->add('places')
            ->add('kilometrage')
            ->add('cv')
            ->add('color')
            ->add('critAir')
            ->add('modele')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
