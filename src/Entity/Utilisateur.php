<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"username"},message="L'utilisateur existe déjà")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=12,minMessage="Plus de 4 caracters",maxMessage="Moins de 12 caracters")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=12,minMessage="Plus de 4 caracters",maxMessage="Moins de 12 caracters")
     */
    private $password;

    /**
     * @Assert\Length(min=5,max=12,minMessage="Plus de 4 caracters",maxMessage="Moins de 12 caracters")
     * @Assert\EqualTo(propertyPath="password",message="Vos mots des passses ne correspondent pas")
     */
    private $verificationPassword;

    /**
     * @ORM\OneToOne(targetEntity=Reparation::class, mappedBy="author", cascade={"persist"})
     */
    private $reparation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getVerificationPassword(): ?string
    {
        return $this->password;
    }

    public function setVerificationPassword(string $verificationPassword): self
    {
        $this->verificationPassword = $verificationPassword;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getReparation(): ?Reparation
    {
        return $this->reparation;
    }

    public function setReparation(Reparation $reparation): self
    {
        // set the owning side of the relation if necessary
        if ($reparation->getAuthor() !== $this) {
            $reparation->setAuthor($this);
        }

        $this->reparation = $reparation;

        return $this;
    }
}
