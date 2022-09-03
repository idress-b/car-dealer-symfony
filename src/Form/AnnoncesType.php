<?php

namespace App\Form;

use App\Entity\Annonces;
use App\Entity\Marques;
use App\Entity\Modeles;
use App\Repository\ModelesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque', EntityType::class, [
                'class' => Marques::class,
                'placeholder' => '<< -choisissez- >>',
                'choice_label' => 'marque',
                'mapped' => false,
                'required' => false

            ])
            ->add('modele', EntityType::class, [
                'class' => Modeles::class,
                'placeholder' => 'choisir un modèle',
                'required' => false
            ])
            ->add('title')
            ->add('subtitle')
            ->add('description')
            ->add('price')
            ->add('annee')
            // ->add('mec')
            ->add('carburant')
            ->add('gearBox')
            ->add('type')
            ->add('portes')
            ->add('places')
            ->add('kilometrage')
            ->add('cv')
            ->add('color')
            ->add('critAir');


        $formModifier = function (FormInterface $form, Marques $marque = null) {

            $modeles = null === $marque ? [] : $marque->getModeles();
            dd($marque);
            $form->add('modele', EntityType::class, [
                'class' => Modeles::class,
                'choices' => $modeles,
                // 'query_builder' => function (ModelesRepository $repository, $int) {
                //     return $repository->createQueryBuilder('m')
                //         ->andWhere('m.marque = :val')
                //         ->setParameter('val', $int);
                // },

                'required' => false
            ]);
        };



        $builder->get('marque')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $marque = $event->getForm()->getData();
            $modeles = null === $marque ? [] : $marque->getModeles();
            dd($marque);


            $event->getForm()->getParent()
                ->add('modele', EntityType::class, [
                    'class' => Modeles::class,
                    'choices' => $modeles,
                    'required' => false
                ]);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
            'csrf_protection' => false
        ]);
    }
}
