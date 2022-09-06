<?php

namespace App\Entity;

use App\Repository\ModelesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelesRepository::class)]
class Modeles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\ManyToOne(inversedBy: 'modeles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marques $marque = null;

    #[ORM\OneToMany(mappedBy: 'modele', targetEntity: Annonces::class)]
    private Collection $annonces;

    #[ORM\OneToMany(mappedBy: 'modele', targetEntity: Car::class)]
    private Collection $cars;

    #[ORM\Column(length: 255)]
    private ?string $rappel_marque = null;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getMarque(): ?Marques
    {
        return $this->marque;
    }

    public function setMarque(?Marques $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, Annonces>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonces $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setModele($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonces $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getModele() === $this) {
                $annonce->setModele(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->modele;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->setModele($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getModele() === $this) {
                $car->setModele(null);
            }
        }

        return $this;
    }

    public function getRappelMarque(): ?string
    {
        return $this->rappel_marque;
    }

    public function setRappelMarque(string $rappel_marque): self
    {
        $this->rappel_marque = $rappel_marque;

        return $this;
    }
}
