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

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AnnoncesType extends AbstractType
{
   public function __construct(private ModelesRepository $modelesRepository)
   {

   }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque', EntityType::class, [
                'class' => Marques::class,
                'placeholder' => '<< -choisissez- >>',
                'mapped'=>false
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
            ->add('carburant')
            ->add('carburant',ChoiceType::class,[
                'expanded'=>true,
                'multiple'=>false,
                'choices'=>[
                    'essence'=>'essence',
                    'diesel'=>'diesel'
                ]
            ])
            ->add('gearBox')
            ->add('type')
            ->add('portes')
            ->add('places')
            ->add('kilometrage')
            ->add('cv')
            ->add('color')
            ->add('critAir');


     
        $builder->get('marque')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $marqueId= (int)$event->getData();
                    
            $modeles = $this->modelesRepository->findBy([
                'marque' => $marqueId
            ]);

          $form=  $event->getForm()->getParent();
        
          $form
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
