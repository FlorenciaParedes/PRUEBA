<?php

namespace App\Entity;

use App\Repository\PandemiaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PandemiaRepository::class)]
class Pandemia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaFin = null;

    #[ORM\Column]
    private ?bool $isActiva = null;

    #[ORM\OneToOne(mappedBy: 'Pandemia', cascade: ['persist', 'remove'])]
    private ?Patologia $patologia = null;

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

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(?\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function isIsActiva(): ?bool
    {
        return $this->isActiva;
    }

    public function setIsActiva(bool $isActiva): self
    {
        $this->isActiva = $isActiva;

        return $this;
    }

    public function getPatologia(): ?Patologia
    {
        return $this->patologia;
    }

    public function setPatologia(?Patologia $patologia): self
    {
        // unset the owning side of the relation if necessary
        if ($patologia === null && $this->patologia !== null) {
            $this->patologia->setPandemia(null);
        }

        // set the owning side of the relation if necessary
        if ($patologia !== null && $patologia->getPandemia() !== $this) {
            $patologia->setPandemia($this);
        }

        $this->patologia = $patologia;

        return $this;
    }
}
