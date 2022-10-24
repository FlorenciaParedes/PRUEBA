<?php

namespace App\Entity;

use App\Repository\PatologiaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatologiaRepository::class)]
class Patologia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?bool $isPandemia = null;

    #[ORM\OneToOne(inversedBy: 'patologia', cascade: ['persist', 'remove'])]
    private ?Pandemia $Pandemia = null;

    #[ORM\ManyToMany(targetEntity: Vacunas::class, mappedBy: 'patologia')]
    private Collection $vacunas;

    public function __construct()
    {
        $this->vacunas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function isIsPandemia(): ?bool
    {
        return $this->isPandemia;
    }

    public function setIsPandemia(bool $isPandemia): self
    {
        $this->isPandemia = $isPandemia;

        return $this;
    }

    public function getPandemia(): ?Pandemia
    {
        return $this->Pandemia;
    }

    public function setPandemia(?Pandemia $Pandemia): self
    {
        $this->Pandemia = $Pandemia;

        return $this;
    }

    /**
     * @return Collection<int, Vacunas>
     */
    public function getVacunas(): Collection
    {
        return $this->vacunas;
    }

    public function addVacuna(Vacunas $vacuna): self
    {
        if (!$this->vacunas->contains($vacuna)) {
            $this->vacunas->add($vacuna);
            $vacuna->addPatologium($this);
        }

        return $this;
    }

    public function removeVacuna(Vacunas $vacuna): self
    {
        if ($this->vacunas->removeElement($vacuna)) {
            $vacuna->removePatologium($this);
        }

        return $this;
    }
}
