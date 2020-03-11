<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
 */
class Stage
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="mesStages", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $monEntreprise;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Formation", inversedBy="mesStages", cascade={"persist"})
     */
    private $mesFormations;

    public function __construct()
    {
        $this->mesFormations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMonEntreprise(): ?Entreprise
    {
        return $this->monEntreprise;
    }

    public function setMonEntreprise(?Entreprise $monEntreprise): self
    {
        $this->monEntreprise = $monEntreprise;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getMesFormations(): Collection
    {
        return $this->mesFormations;
    }

    public function addMesFormation(Formation $mesFormation): self
    {
        if (!$this->mesFormations->contains($mesFormation)) {
            $this->mesFormations[] = $mesFormation;
        }

        return $this;
    }

    public function removeMesFormation(Formation $mesFormation): self
    {
        if ($this->mesFormations->contains($mesFormation)) {
            $this->mesFormations->removeElement($mesFormation);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getTitre();
    }
}
