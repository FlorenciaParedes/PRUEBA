<?php

namespace App\Entity;

use App\Repository\CondicionesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CondicionesRepository::class)]
class Condiciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'condiciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?vacuna $condicion = null;

    #[ORM\Column(length: 100)]
    private ?string $descripcion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCondicion(): ?vacuna
    {
        return $this->condicion;
    }

    public function setCondicion(?vacuna $condicion): self
    {
        $this->condicion = $condicion;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}
