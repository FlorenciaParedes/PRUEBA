<?php

namespace App\Entity;

use App\Repository\DesarrolladorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DesarrolladorRepository::class)]
class Desarrollador
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $laboratorio = null;

    #[ORM\ManyToMany(targetEntity: Vacunas::class, inversedBy: 'desarolladores')]
    private Collection $vacunas;

    public function __construct()
    {
        $this->vacunas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLaboratorio(): ?string
    {
        return $this->laboratorio;
    }

    public function setLaboratorio(string $laboratorio): self
    {
        $this->laboratorio = $laboratorio;

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
        }

        return $this;
    }

    public function removeVacuna(Vacunas $vacuna): self
    {
        $this->vacunas->removeElement($vacuna);

        return $this;
    }
}
