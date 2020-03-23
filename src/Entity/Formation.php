<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormationRepository")
 */
class Formation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nomCourt;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomLong;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Stage", mappedBy="mesFormations")
     */
    private $mesStages;

    /**
     * @Gedmo\Slug(fields={"nomCourt"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->mesStages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCourt(): ?string
    {
        return $this->nomCourt;
    }

    public function setNomCourt(string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    public function getNomLong(): ?string
    {
        return $this->nomLong;
    }

    public function setNomLong(string $nomLong): self
    {
        $this->nomLong = $nomLong;

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
            $mesStage->addMesFormation($this);
        }

        return $this;
    }

    public function removeMesStage(Stage $mesStage): self
    {
        if ($this->mesStages->contains($mesStage)) {
            $this->mesStages->removeElement($mesStage);
            $mesStage->removeMesFormation($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNomCourt();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

}
