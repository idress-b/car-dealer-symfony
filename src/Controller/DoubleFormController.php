<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Entity\Annonces;
use App\Form\AnnonceType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DoubleFormController extends AbstractController
{
    #[Route('/double/form', name: 'app_double_form')]
    public function index(): Response
    {

        $car = new Car;
        $formCar = $this->createForm(CarType::class, $car);

        $annonce = new Annonces;
        $formAnnonce = $this->createForm(AnnonceType::class, $annonce);

        if ($formCar->isSubmitted() && $formCar->isValid()) {
            dd($car);
            return $this->redirectToRoute('app_double_form');
        }

        if ($formAnnonce->isSubmitted() && $formAnnonce->isValid()) {
            dd($annonce);
        }

        return $this->render('double_form/index.html.twig', [
            'formCar' => $formCar->createView(),
            'formAnnonce' => $formAnnonce->createView()
        ]);
    }
}
