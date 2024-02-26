<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RencontreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RencontreRepository::class)]
#[ApiResource]
class Rencontre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $heure = null;

    #[ORM\Column]
    private ?bool $fini = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Poule $poule = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Equipe $equipe1 = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Equipe $equipe2 = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Arbitre $arbitre = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Terrain $terrain = null;

    #[ORM\OneToMany(targetEntity: Set::class, mappedBy: 'rencontre')]
    private Collection $sets;

    public function __construct()
    {
        $this->sets = new ArrayCollection();
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

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(?\DateTimeInterface $heure): static
    {
        $this->heure = $heure;

        return $this;
    }

    public function isFini(): ?bool
    {
        return $this->fini;
    }

    public function setFini(bool $fini): static
    {
        $this->fini = $fini;

        return $this;
    }

    public function getPouleId(): ?Poule
    {
        return $this->poule;
    }

    public function setPouleId(?Poule $poule): static
    {
        $this->poule = $poule;

        return $this;
    }

    public function getEquipe1Id(): ?Equipe
    {
        return $this->equipe1;
    }

    public function setEquipe1Id(?Equipe $equipe1): static
    {
        $this->equipe1 = $equipe1;

        return $this;
    }

    public function getEquipe2Id(): ?Equipe
    {
        return $this->equipe2;
    }

    public function setEquipe2Id(?Equipe $equipe2): static
    {
        $this->equipe2 = $equipe2;

        return $this;
    }

    public function getArbitreId(): ?Arbitre
    {
        return $this->arbitre;
    }

    public function setArbitreId(?Arbitre $arbitre): static
    {
        $this->arbitre = $arbitre;

        return $this;
    }

    public function getTerrainId(): ?Terrain
    {
        return $this->terrain;
    }

    public function setTerrainId(?Terrain $terrain): static
    {
        $this->terrain = $terrain;

        return $this;
    }

    /**
     * @return Collection<int, Set>
     */
    public function getSets(): Collection
    {
        return $this->sets;
    }

    public function addSet(Set $set): static
    {
        if (!$this->sets->contains($set)) {
            $this->sets->add($set);
            $set->setRencontreId($this);
        }

        return $this;
    }

    public function removeSet(Set $set): static
    {
        if ($this->sets->removeElement($set)) {
            // set the owning side to null (unless already changed)
            if ($set->getRencontreId() === $this) {
                $set->setRencontreId(null);
            }
        }

        return $this;
    }
}
