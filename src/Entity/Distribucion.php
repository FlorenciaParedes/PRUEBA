<?php

namespace App\Entity;

use App\Repository\DistribucionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DistribucionRepository::class)]
class Distribucion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vacunas $vacuna = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Desarrollador $desarrollador = null;

    #[ORM\ManyToOne(inversedBy: 'distribuciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Provincia $provincia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getVacuna(): ?Vacunas
    {
        return $this->vacuna;
    }

    public function setVacuna(?Vacunas $vacuna): self
    {
        $this->vacuna = $vacuna;

        return $this;
    }

    public function getDesarrollador(): ?Desarrollador
    {
        return $this->desarrollador;
    }

    public function setDesarrollador(?Desarrollador $desarrollador): self
    {
        $this->desarrollador = $desarrollador;

        return $this;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }
}
