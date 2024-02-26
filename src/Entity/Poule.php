<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PouleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PouleRepository::class)]
#[ApiResource]
class Poule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $equipe_max = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'poules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Phase $phase = null;

  

    #[ORM\OneToMany(targetEntity: Rencontre::class, mappedBy: 'poule', orphanRemoval: true)]
    private Collection $rencontres;

    #[ORM\OneToMany(targetEntity: EquipePoule::class, mappedBy: 'poule')]
    private Collection $equipePoules;

    public function __construct()
    {

        $this->rencontres = new ArrayCollection();
        $this->equipePoules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEquipeMax(): ?int
    {
        return $this->equipe_max;
    }

    public function setEquipeMax(?int $equipe_max): static
    {
        $this->equipe_max = $equipe_max;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPhaseId(): ?Phase
    {
        return $this->phase;
    }

    public function setPhaseId(?Phase $phase): static
    {
        $this->phase = $phase;

        return $this;
    }

  
    /**
     * @return Collection<int, Rencontre>
     */
    public function getRencontres(): Collection
    {
        return $this->rencontres;
    }

    public function addRencontre(Rencontre $rencontre): static
    {
        if (!$this->rencontres->contains($rencontre)) {
            $this->rencontres->add($rencontre);
            $rencontre->setPouleId($this);
        }

        return $this;
    }

    public function removeRencontre(Rencontre $rencontre): static
    {
        if ($this->rencontres->removeElement($rencontre)) {
            // set the owning side to null (unless already changed)
            if ($rencontre->getPouleId() === $this) {
                $rencontre->setPouleId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EquipePoule>
     */
    public function getEquipePoules(): Collection
    {
        return $this->equipePoules;
    }

    public function addEquipePoule(EquipePoule $equipePoule): static
    {
        if (!$this->equipePoules->contains($equipePoule)) {
            $this->equipePoules->add($equipePoule);
            $equipePoule->setPoule($this);
        }

        return $this;
    }

    public function removeEquipePoule(EquipePoule $equipePoule): static
    {
        if ($this->equipePoules->removeElement($equipePoule)) {
            // set the owning side to null (unless already changed)
            if ($equipePoule->getPoule() === $this) {
                $equipePoule->setPoule(null);
            }
        }

        return $this;
    }
}
