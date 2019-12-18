<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $site;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="monEntreprise")
     */
    private $mesStages;

    public function __construct()
    {
        $this->mesStages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(?string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getMesStages(): Collection
    {
        return $this->mesStages;
    }

    public function addMesStage(Stage $mesStage): self
    {
        if (!$this->mesStages->contains($mesStage)) {
            $this->mesStages[] = $mesStage;
            $mesStage->setMonEntreprise($this);
        }

        return $this;
    }

    public function removeMesStage(Stage $mesStage): self
    {
        if ($this->mesStages->contains($mesStage)) {
            $this->mesStages->removeElement($mesStage);
            // set the owning side to null (unless already changed)
            if ($mesStage->getMonEntreprise() === $this) {
                $mesStage->setMonEntreprise(null);
            }
        }

        return $this;
    }
}
