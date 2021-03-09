<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Reparation::class, mappedBy="category")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_reparation;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Reparation[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Reparation $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
            $category->setCategory($this);
        }

        return $this;
    }

    public function removeCategory(Reparation $category): self
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategory() === $this) {
                $category->setCategory(null);
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
