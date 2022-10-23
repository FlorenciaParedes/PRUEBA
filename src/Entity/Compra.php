<?php

namespace App\Entity;

use App\Repository\CompraRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompraRepository::class)]
class Compra
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
    private ?desarrollador $desarrollador = null;

    #[ORM\ManyToOne(inversedBy: 'compras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?estado $estado = null;

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

    public function getDesarrollador(): ?desarrollador
    {
        return $this->desarrollador;
    }

    public function setDesarrollador(?desarrollador $desarrollador): self
    {
        $this->desarrollador = $desarrollador;

        return $this;
    }

    public function getEstado(): ?estado
    {
        return $this->estado;
    }

    public function setEstado(?estado $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
