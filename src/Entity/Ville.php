<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_reparation;

    /**
     * @ORM\OneToMany(targetEntity=Reparation::class, mappedBy="ville")
     */
    private $ville;

    public function __construct()
    {
        $this->ville = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom_reparation;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomReparation(): ?string
    {
        return $this->nom_reparation;
    }

    public function setNomReparation(string $nom_reparation): self
    {
        $this->nom_reparation = $nom_reparation;

        return $this;
    }

    /**
     * @return Collection|Reparation[]
     */
    public function getVille(): Collection
    {
        return $this->ville;
    }

    public function addVille(Reparation $ville): self
    {
        if (!$this->ville->contains($ville)) {
            $this->ville[] = $ville;
            $ville->setVille($this);
        }

        return $this;
    }

    public function removeVille(Reparation $ville): self
    {
        if ($this->ville->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getVille() === $this) {
                $ville->setVille(null);
            }
        }

        return $this;
    }
}
