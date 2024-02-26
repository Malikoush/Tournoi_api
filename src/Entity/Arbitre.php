<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArbitreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArbitreRepository::class)]
#[ApiResource]
class Arbitre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Equipe $equipe = null;

    #[ORM\OneToMany(targetEntity: Rencontre::class, mappedBy: 'arbitre')]
    private Collection $rencontres;

    public function __construct()
    {
        $this->rencontres = new ArrayCollection();
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

    public function getEquipeId(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipeId(?Equipe $equipe): static
    {
        $this->equipe = $equipe;

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
            $rencontre->setArbitreId($this);
        }

        return $this;
    }

    public function removeRencontre(Rencontre $rencontre): static
    {
        if ($this->rencontres->removeElement($rencontre)) {
            // set the owning side to null (unless already changed)
            if ($rencontre->getArbitreId() === $this) {
                $rencontre->setArbitreId(null);
            }
        }

        return $this;
    }
}
