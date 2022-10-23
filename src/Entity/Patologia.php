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

    #[ORM\OneToOne(mappedBy: 'patologia', cascade: ['persist', 'remove'])]
    private ?Pandemia $pandemia = null;

    #[ORM\Column]
    private ?bool $pandemiaActiva = null;

    #[ORM\ManyToMany(targetEntity: Vacuna::class, mappedBy: 'patologia')]
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

    public function getPandemia(): ?Pandemia
    {
        return $this->pandemia;
    }

    public function setPandemia(Pandemia $pandemia): self
    {
        // set the owning side of the relation if necessary
        if ($pandemia->getPatologia() !== $this) {
            $pandemia->setPatologia($this);
        }

        $this->pandemia = $pandemia;

        return $this;
    }

    public function isPandemiaActiva(): ?bool
    {
        return $this->pandemiaActiva;
    }

    public function setPandemiaActiva(bool $pandemiaActiva): self
    {
        $this->pandemiaActiva = $pandemiaActiva;

        return $this;
    }

    /**
     * @return Collection<int, Vacuna>
     */
    public function getVacunas(): Collection
    {
        return $this->vacunas;
    }

    public function addVacuna(Vacuna $vacuna): self
    {
        if (!$this->vacunas->contains($vacuna)) {
            $this->vacunas->add($vacuna);
            $vacuna->addPatologium($this);
        }

        return $this;
    }

    public function removeVacuna(Vacuna $vacuna): self
    {
        if ($this->vacunas->removeElement($vacuna)) {
            $vacuna->removePatologium($this);
        }

        return $this;
    }
}
