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
    private ?vacuna $vacuna = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?desarrollador $desarollador = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?provincias $provincia = null;

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

    public function getVacuna(): ?vacuna
    {
        return $this->vacuna;
    }

    public function setVacuna(?vacuna $vacuna): self
    {
        $this->vacuna = $vacuna;

        return $this;
    }

    public function getDesarollador(): ?desarrollador
    {
        return $this->desarollador;
    }

    public function setDesarollador(?desarrollador $desarollador): self
    {
        $this->desarollador = $desarollador;

        return $this;
    }

    public function getProvincia(): ?provincias
    {
        return $this->provincia;
    }

    public function setProvincia(?provincias $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }
}
