<?php

namespace App\Entity;

use App\Repository\VacunaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VacunaRepository::class)]
class Vacuna
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vacunas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?lote $lote = null;

    #[ORM\ManyToMany(targetEntity: Desarrollador::class, mappedBy: 'vacunas')]
    private Collection $desarrolladores;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $cantidadDosis = null;

    #[ORM\OneToMany(mappedBy: 'condicion', targetEntity: Condiciones::class)]
    private Collection $condiciones;

    #[ORM\ManyToMany(targetEntity: patologia::class, inversedBy: 'vacunas')]
    private Collection $patologia;

    public function __construct()
    {
        $this->desarrolladores = new ArrayCollection();
        $this->condiciones = new ArrayCollection();
        $this->patologia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLote(): ?lote
    {
        return $this->lote;
    }

    public function setLote(?lote $lote): self
    {
        $this->lote = $lote;

        return $this;
    }

    /**
     * @return Collection<int, Desarrollador>
     */
    public function getDesarrolladores(): Collection
    {
        return $this->desarrolladores;
    }

    public function addDesarrolladore(Desarrollador $desarrolladore): self
    {
        if (!$this->desarrolladores->contains($desarrolladore)) {
            $this->desarrolladores->add($desarrolladore);
            $desarrolladore->addVacuna($this);
        }

        return $this;
    }

    public function removeDesarrolladore(Desarrollador $desarrolladore): self
    {
        if ($this->desarrolladores->removeElement($desarrolladore)) {
            $desarrolladore->removeVacuna($this);
        }

        return $this;
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

    public function getCantidadDosis(): ?int
    {
        return $this->cantidadDosis;
    }

    public function setCantidadDosis(int $cantidadDosis): self
    {
        $this->cantidadDosis = $cantidadDosis;

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
            $condicione->setCondicion($this);
        }

        return $this;
    }

    public function removeCondicione(Condiciones $condicione): self
    {
        if ($this->condiciones->removeElement($condicione)) {
            // set the owning side to null (unless already changed)
            if ($condicione->getCondicion() === $this) {
                $condicione->setCondicion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, patologia>
     */
    public function getPatologia(): Collection
    {
        return $this->patologia;
    }

    public function addPatologium(patologia $patologium): self
    {
        if (!$this->patologia->contains($patologium)) {
            $this->patologia->add($patologium);
        }

        return $this;
    }

    public function removePatologium(patologia $patologium): self
    {
        $this->patologia->removeElement($patologium);

        return $this;
    }
}
