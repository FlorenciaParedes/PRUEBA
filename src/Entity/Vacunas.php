<?php

namespace App\Entity;

use App\Repository\VacunasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VacunasRepository::class)]
class Vacunas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'vacunas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lote $lote = null;

    #[ORM\ManyToMany(targetEntity: Condiciones::class, inversedBy: 'vacunas')]
    private Collection $condiciones;

    #[ORM\ManyToMany(targetEntity: Patologia::class, inversedBy: 'vacunas')]
    private Collection $patologia;

    #[ORM\ManyToMany(targetEntity: Desarrollador::class, mappedBy: 'vacunas')]
    private Collection $desarolladores;

    public function __construct()
    {
        $this->condiciones = new ArrayCollection();
        $this->patologia = new ArrayCollection();
        $this->desarolladores = new ArrayCollection();
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

    public function getLote(): ?Lote
    {
        return $this->lote;
    }

    public function setLote(?Lote $lote): self
    {
        $this->lote = $lote;

        return $this;
    }

    /**
     * @return Collection<int, Condiciones>
     */
    public function getCondiciones(): Collection
    {
        return $this->condiciones;
    }

    public function addCondicione(Condiciones $condicione): self
    {
        if (!$this->condiciones->contains($condicione)) {
            $this->condiciones->add($condicione);
        }

        return $this;
    }

    public function removeCondicione(Condiciones $condicione): self
    {
        $this->condiciones->removeElement($condicione);

        return $this;
    }

    /**
     * @return Collection<int, Patologia>
     */
    public function getPatologia(): Collection
    {
        return $this->patologia;
    }

    public function addPatologium(Patologia $patologium): self
    {
        if (!$this->patologia->contains($patologium)) {
            $this->patologia->add($patologium);
        }

        return $this;
    }

    public function removePatologium(Patologia $patologium): self
    {
        $this->patologia->removeElement($patologium);

        return $this;
    }

    /**
     * @return Collection<int, Desarrollador>
     */
    public function getDesarolladores(): Collection
    {
        return $this->desarolladores;
    }

    public function addDesarolladore(Desarrollador $desarolladore): self
    {
        if (!$this->desarolladores->contains($desarolladore)) {
            $this->desarolladores->add($desarolladore);
            $desarolladore->addVacuna($this);
        }

        return $this;
    }

    public function removeDesarolladore(Desarrollador $desarolladore): self
    {
        if ($this->desarolladores->removeElement($desarolladore)) {
            $desarolladore->removeVacuna($this);
        }

        return $this;
    }
}
