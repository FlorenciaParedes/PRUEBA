<?php

namespace App\Entity;

use App\Repository\ProvinciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProvinciaRepository::class)]
class Provincia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'provincia', targetEntity: Distribucion::class)]
    private Collection $distribuciones;

    public function __construct()
    {
        $this->distribuciones = new ArrayCollection();
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

    /**
     * @return Collection<int, Distribucion>
     */
    public function getDistribuciones(): Collection
    {
        return $this->distribuciones;
    }

    public function addDistribucione(Distribucion $distribucione): self
    {
        if (!$this->distribuciones->contains($distribucione)) {
            $this->distribuciones->add($distribucione);
            $distribucione->setProvincia($this);
        }

        return $this;
    }

    public function removeDistribucione(Distribucion $distribucione): self
    {
        if ($this->distribuciones->removeElement($distribucione)) {
            // set the owning side to null (unless already changed)
            if ($distribucione->getProvincia() === $this) {
                $distribucione->setProvincia(null);
            }
        }

        return $this;
    }
}
