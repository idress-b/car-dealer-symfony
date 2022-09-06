<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Marques;
use App\Entity\Modeles;
use App\Repository\ModelesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CarType extends AbstractType
{
   
    public function __construct(private ModelesRepository $modelesRepository) {}
   
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('carburant')
            ->add('type')
            ->add('portes')
            ->add('places')
            ->add('kilometrage')
            ->add('cv')
            ->add('marque', EntityType::class, [
                'class' => Marques::class,
                'placeholder' => '<< Choisissez >>',
                'mapped' => false
            ])

            ->add('modele', EntityType::class, [
                'class' => Modeles::class,
                'placeholder' => 'choisir un modèle',
                'disabled' => true
            ])
            ->add('annee', ChoiceType::class, [
                'label' => 'Année',
                'help' => "veuillez choisir l'année",
                'placeholder' => '<< Choisissez >>',
                'choices' => array_combine(range(2022, 1970), range(2022, 1970))

            ])
            ->add('gearBox', ChoiceType::class, [
                'label' => 'Boite de vitesse',
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'Manuelle' => 'manuelle',
                    'Automatique' => 'automatique'
                ]
            ])
            ->add('carburant', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'Essence' => 'essence',
                    'Diesel' => 'diesel',
                    'GPL' => 'gpl',
                    'Electrique' => 'electrique',
                    'Autre' => 'autre'
                ]
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Carrosserie',
                'placeholder' => '<< Choisissez >>',
                'choices' => Car::CAROSSERIE
            ])
            ->add('portes', ChoiceType::class, [
                'label' => 'Nombre de portes',
                'placeholder' => '<< Choisissez >>',
                'choices' => Car::PORTES
            ])
            ->add('places', ChoiceType::class, [
                'label' => 'Nombre de places',
                'placeholder' => '<< Choisissez >>',
                'choices' => Car::PLACES
            ])
            ->add('kilometrage', IntegerType::class)
            ->add('cv', IntegerType::class)
            ->add('color')
            ->add('critAir', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => Car::CRITAIR
            ]);



        $builder->get('marque')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $marqueId = (int)$event->getData();

            $modeles = $this->modelesRepository->findBy([
                'marque' => $marqueId
            ]);

            $form =  $event->getForm()->getParent();

            $form
                ->add('modele', EntityType::class, [
                    'class' => Modeles::class,
                    'choices' => $modeles,
                    'placeholder' => '<< Choisissez >>',
                    
                ]);
        });
    }
        
   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
