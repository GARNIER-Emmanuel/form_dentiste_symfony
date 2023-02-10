<?php

namespace App\Entity;

use App\Repository\InfoClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoClientRepository::class)]
class InfoClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $docteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?String $forme_machoire = null;

    #[ORM\Column(nullable: true)]
    private ?bool $bruxisme = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sexe $sexe = null;

    #[ORM\ManyToOne(inversedBy: 'forme')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FormeMachoire $formeMachoire = null;

    #[ORM\ManyToMany(targetEntity: RendezVous::class, mappedBy: 'relation')]
    private Collection $rendezVouses;

    public function __construct()
    {
        $this->rendezVouses = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getDocteur(): ?string
    {
        return $this->docteur;
    }

    public function setDocteur(string $docteur): self
    {
        $this->docteur = $docteur;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getFormeMachoire(): ?FormeMachoire
    {
        return $this->formeMachoire;
    }

    public function setFormeMachoire(?FormeMachoire $formeMachoire): self
    {
        $this->formeMachoire = $formeMachoire;

        return $this;
    }

    public function getFormeM(): ?String
    {
        return $this->forme_machoire;
    }

    public function setFormeM(?String $forme_machoire): self
    {
        $this->forme_machoire = $forme_machoire;

        return $this;
    }
    
    public function isBruxisme(): ?bool
    {
        return $this->bruxisme;
    }

    public function setBruxisme(?bool $bruxisme): self
    {
        $this->bruxisme = $bruxisme;

        return $this;
    }

    public function getSexe(): ?Sexe
    {
        return $this->sexe;
    }

    public function setSexe(?Sexe $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * @return Collection<int, RendezVous>
     */
    public function getRendezVouses(): Collection
    {
        return $this->rendezVouses;
    }

    public function addRendezVouse(RendezVous $rendezVouse): self
    {
        if (!$this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->add($rendezVouse);
            $rendezVouse->addRelation($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): self
    {
        if ($this->rendezVouses->removeElement($rendezVouse)) {
            $rendezVouse->removeRelation($this);
        }

        return $this;
    }

    
}
