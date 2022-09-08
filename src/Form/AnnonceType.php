<?php

namespace App\Form;

use App\Entity\Annonces;
use App\Entity\Car;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('description')
            ->add('price')
            // ->add('test', CollectionType::class, [
            //     'entry_type' => ImageType::class,
            //     'mapped' => false,
            //     'prototype' => true,
            //     'by_reference' => false,
            //     'allow_add' => true,
            //     'allow_delete' => true,
            //     'error_bubbling' => false
            ->add('images', FileType::class, [
                'mapped' => false,
                'label' => 'Images',
                'multiple' => true,
                // 'constraints' => [
                //     new Image(
                //         [
                //             'maxSize' => '1M'
                //         ]
                //     )
                // ]

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
