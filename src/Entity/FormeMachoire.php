<?php

namespace App\Entity;

use App\Repository\FormeMachoireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormeMachoireRepository::class)]
class FormeMachoire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'formeMachoire', targetEntity: InfoClient::class)]
    private Collection $forme;

    #[ORM\Column(length: 255)]
    private ?string $typeforme = null;

    public function __construct()
    {
        $this->forme = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    
    

    public function getTypeforme(): ?string
    {
        return $this->typeforme;
    }

    public function setTypeforme(string $typeforme): self
    {
        $this->typeforme = $typeforme;

        return $this;
    }
}
