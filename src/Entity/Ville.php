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
     * @ORM\OneToMany(targetEntity=Reparation::class, mappedBy="nom_reparation")
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_reparation;

    public function __construct()
    {
        $this->ville = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $ville->setNomReparation($this);
        }

        return $this;
    }

    public function removeVille(Reparation $ville): self
    {
        if ($this->ville->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getNomReparation() === $this) {
                $ville->setNomReparation(null);
            }
        }

        return $this;
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
}
