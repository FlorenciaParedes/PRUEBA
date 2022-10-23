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

    #[ORM\ManyToMany(targetEntity: vacuna::class, inversedBy: 'desarrolladores')]
    private Collection $vacunas;

    #[ORM\Column(length: 30)]
    private ?string $laboratorio = null;

    public function __construct()
    {
        $this->vacunas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, vacuna>
     */
    public function getVacunas(): Collection
    {
        return $this->vacunas;
    }

    public function addVacuna(vacuna $vacuna): self
    {
        if (!$this->vacunas->contains($vacuna)) {
            $this->vacunas->add($vacuna);
        }

        return $this;
    }

    public function removeVacuna(vacuna $vacuna): self
    {
        $this->vacunas->removeElement($vacuna);

        return $this;
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
}
