<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(options:["default"=> 0])]
    private ?int $point = null;

    #[ORM\Column(length: 25)]
    private ?string $statut = null;

    #[ORM\Column(type: "datetime_immutable", options:["default"=> "CURRENT_TIMESTAMP"])]
    private ?\DateTimeImmutable $date_creation = null;

    #[ORM\ManyToMany(targetEntity: Poule::class, inversedBy: 'equipes')]
    private Collection $poule_id;

    #[ORM\ManyToOne(inversedBy: 'equipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tournoi $tournoi_id = null;

    #[ORM\OneToMany(targetEntity: Joueur::class, mappedBy: 'equipe_id', orphanRemoval: true)]
    private Collection $joueurs;

    #[ORM\OneToMany(targetEntity: Rencontre::class, mappedBy: 'equipe1_id')]
    private Collection $rencontres;

    public function __construct()
    {
        $this->poule_id = new ArrayCollection();
        $this->joueurs = new ArrayCollection();
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

    public function getPoint(): ?int
    {
        return $this->point;
    }

    public function setPoint(int $point): static
    {
        $this->point = $point;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeImmutable $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    /**
     * @return Collection<int, Poule>
     */
    public function getPouleId(): Collection
    {
        return $this->poule_id;
    }

    public function addPouleId(Poule $pouleId): static
    {
        if (!$this->poule_id->contains($pouleId)) {
            $this->poule_id->add($pouleId);
        }

        return $this;
    }

    public function removePouleId(Poule $pouleId): static
    {
        $this->poule_id->removeElement($pouleId);

        return $this;
    }

    public function getTournoiId(): ?Tournoi
    {
        return $this->tournoi_id;
    }

    public function setTournoiId(?Tournoi $tournoi_id): static
    {
        $this->tournoi_id = $tournoi_id;

        return $this;
    }

    /**
     * @return Collection<int, Joueur>
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): static
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs->add($joueur);
            $joueur->setEquipeId($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): static
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getEquipeId() === $this) {
                $joueur->setEquipeId(null);
            }
        }

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
            $rencontre->setEquipe1Id($this);
        }

        return $this;
    }

    public function removeRencontre(Rencontre $rencontre): static
    {
        if ($this->rencontres->removeElement($rencontre)) {
            // set the owning side to null (unless already changed)
            if ($rencontre->getEquipe1Id() === $this) {
                $rencontre->setEquipe1Id(null);
            }
        }

        return $this;
    }
}
