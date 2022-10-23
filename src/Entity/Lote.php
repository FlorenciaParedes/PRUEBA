<?php

namespace App\Entity;

use App\Repository\LoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoteRepository::class)]
class Lote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $identificador = null;

    #[ORM\OneToMany(mappedBy: 'lote', targetEntity: Vacuna::class)]
    private Collection $vacunas;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaVencimiento = null;

    public function __construct()
    {
        $this->vacunas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentificador(): ?int
    {
        return $this->identificador;
    }

    public function setIdentificador(int $identificador): self
    {
        $this->identificador = $identificador;

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
            $vacuna->setLote($this);
        }

        return $this;
    }

    public function removeVacuna(Vacuna $vacuna): self
    {
        if ($this->vacunas->removeElement($vacuna)) {
            // set the owning side to null (unless already changed)
            if ($vacuna->getLote() === $this) {
                $vacuna->setLote(null);
            }
        }

        return $this;
    }

    public function getFechaVencimiento(): ?\DateTimeInterface
    {
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento(\DateTimeInterface $fechaVencimiento): self
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }
}
