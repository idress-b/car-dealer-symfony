<?php

namespace App\Form;

use App\Entity\Annonces;
use App\Entity\Marques;
use App\Entity\Modeles;
use App\Repository\ModelesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                //  'mapped' => false,
                'placeholder' => '<< -choisissez- >>',
                //  'compound' => true

            ])




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
            ->add('critAir');
        // ->add('modele', EntityType::class, [
        //     'class' => Modeles::class,
        //     'placeholder' => '',
        //     'disabled' => true
        // ]);

        $formModifier = function (FormInterface $form, Marques $marque = null) {
            $marqueId = null === $marque ? [] : $marque->getModeles();
            if ($marque !== null) dd($marqueId);
            $form->add('modele', EntityType::class, [
                'class' => Modeles::class,
                'placeholder' => 'placeholder',
                'choices' => $marqueId,
                'required' => false
            ]);
        };

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {

            $form = $event->getForm();
            $data = $event->getData();
            dd($data);
            $formModifier($form,);
        });

        $builder->get('marque')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($formModifier) {
            $marque = $event->getForm()->getData();
            $formModifier($event->getForm()->getParent(), $marque);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
