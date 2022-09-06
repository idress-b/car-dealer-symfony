<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    const CAROSSERIE = [
        '4x4, SUV, CROSSOVER' => 'suv',
        'Citadine' => 'citadine',
        'Berline' => 'berline',
        'Break' => 'break',
        'Cabriolet' => 'cabriolet',
        'Coupé' => 'coupe',
        'Monospace' => 'monospace',
        'Minibus' => 'minibus',
        'Pick-up' => 'pickup',
        'Voiture société,commerciale' => 'societe',
        'Autre' => 'autre'
    ];

    const PORTES = [
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6 ou plus' => 6
    ];

    const PLACES = [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7 ou plus' => 7
    ];

    const CRITAIR = [
        '0' => 0,
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        'Non classé' => 6
    ];


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $annee = null;

    #[ORM\Column(length: 255)]
    private ?string $carburant = null;

    #[ORM\Column(length: 255)]
    private ?string $gearbox = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $portes = null;

    #[ORM\Column(length: 255)]
    private ?int $places = null;

    #[ORM\Column]
    private ?int $kilometrage = null;

    #[ORM\Column(nullable: true)]
    private ?int $cv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(nullable: true)]
    private ?int $critair = null;

    #[ORM\OneToOne(inversedBy: 'car', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Annonces $annonce = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modeles $modele = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getGearbox(): ?string
    {
        return $this->gearbox;
    }

    public function setGearbox(string $gearbox): self
    {
        $this->gearbox = $gearbox;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPortes(): ?int
    {
        return $this->portes;
    }

    public function setPortes(int $portes): self
    {
        $this->portes = $portes;

        return $this;
    }

    public function getPlaces(): ?string
    {
        return $this->places;
    }

    public function setPlaces(string $places): self
    {
        $this->places = $places;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getCv(): ?int
    {
        return $this->cv;
    }

    public function setCv(int $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getCritair(): ?int
    {
        return $this->critair;
    }

    public function setCritair(?int $critair): self
    {
        $this->critair = $critair;

        return $this;
    }

    public function getAnnonce(): ?Annonces
    {
        return $this->annonce;
    }

    public function setAnnonce(Annonces $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }

    public function getModele(): ?Modeles
    {
        return $this->modele;
    }

    public function setModele(?Modeles $modele): self
    {
        $this->modele = $modele;

        return $this;
    }
}
