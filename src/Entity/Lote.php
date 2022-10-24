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
    private ?int $Identificador = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaVencimiento = null;

    #[ORM\OneToMany(mappedBy: 'lote', targetEntity: Vacunas::class)]
    private Collection $vacunas;

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
        return $this->Identificador;
    }

    public function setIdentificador(int $Identificador): self
    {
        $this->Identificador = $Identificador;

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
            $vacuna->setLote($this);
        }

        return $this;
    }

    public function removeVacuna(Vacunas $vacuna): self
    {
        if ($this->vacunas->removeElement($vacuna)) {
            // set the owning side to null (unless already changed)
            if ($vacuna->getLote() === $this) {
                $vacuna->setLote(null);
            }
        }

        return $this;
    }
}
