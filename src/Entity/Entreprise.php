<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @Assert\Length(
     * min = 4,
     * minMessage = "Le nom de l'entreprise doit faire au minimum {{ limit }} caractères.",
     * max = 255,
     * maxMessage = "Le nom de l'entreprise doit faire au maximum {{ limit }} caractères."
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\Regex(
     * pattern="#^[1-9][0-9]{0,2}((bis)|( bis))? #",
     * message="Le numéro de rue semble incorrect"
     * )
     * 
     * @Assert\Regex(
     * pattern="# rue | avenue | boulevard | impasse | allée | allee | place | route | voie #",
     * message="Le type de route/voie semble incorrect"
     * )
     * 
     * @Assert\Regex(
     * pattern="# [0-9]{5} #", 
     * message="Il semble y avoir un problème avec le code postal"
     * )
     * 
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Url
     */
    private $site;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="monEntreprise")
     */
    private $mesStages;

    /**
     * @Gedmo\Slug(fields={"nom", "activite"})
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

    public function __toString()
    {
        return $this->getNom();
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
