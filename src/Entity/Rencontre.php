<?php

namespace App\Entity;

use App\Repository\RencontreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RencontreRepository::class)]
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
    private ?Poule $poule_id = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Equipe $equipe1_id = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Equipe $equipe2_id = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Arbitre $arbitre_id = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    private ?Terrain $terrain_id = null;

    #[ORM\OneToMany(targetEntity: Set::class, mappedBy: 'rencontre_id')]
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
        return $this->poule_id;
    }

    public function setPouleId(?Poule $poule_id): static
    {
        $this->poule_id = $poule_id;

        return $this;
    }

    public function getEquipe1Id(): ?Equipe
    {
        return $this->equipe1_id;
    }

    public function setEquipe1Id(?Equipe $equipe1_id): static
    {
        $this->equipe1_id = $equipe1_id;

        return $this;
    }

    public function getEquipe2Id(): ?Equipe
    {
        return $this->equipe2_id;
    }

    public function setEquipe2Id(?Equipe $equipe2_id): static
    {
        $this->equipe2_id = $equipe2_id;

        return $this;
    }

    public function getArbitreId(): ?Arbitre
    {
        return $this->arbitre_id;
    }

    public function setArbitreId(?Arbitre $arbitre_id): static
    {
        $this->arbitre_id = $arbitre_id;

        return $this;
    }

    public function getTerrainId(): ?Terrain
    {
        return $this->terrain_id;
    }

    public function setTerrainId(?Terrain $terrain_id): static
    {
        $this->terrain_id = $terrain_id;

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
