<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RepresentantRepository")
 */
class Representant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email_2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eleve", mappedBy="representants")
     */
    private $eleves;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Utilisateur", cascade={"persist", "remove"})
     */
    private $role_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Utilisateur", cascade={"persist", "remove"})
     */
    private $roles;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse1(): ?string
    {
        return $this->adresse_1;
    }

    public function setAdresse1(string $adresse_1): self
    {
        $this->adresse_1 = $adresse_1;

        return $this;
    }

    public function getAdresse2(): ?string
    {
        return $this->adresse_2;
    }

    public function setAdresse2(string $adresse_2): self
    {
        $this->adresse_2 = $adresse_2;

        return $this;
    }

    public function getTelephone1(): ?string
    {
        return $this->telephone_1;
    }

    public function setTelephone1(?string $telephone_1): self
    {
        $this->telephone_1 = $telephone_1;

        return $this;
    }

    public function getTelephone2(): ?string
    {
        return $this->telephone_2;
    }

    public function setTelephone2(?string $telephone_2): self
    {
        $this->telephone_2 = $telephone_2;

        return $this;
    }

    public function getEmail1(): ?string
    {
        return $this->email_1;
    }

    public function setEmail1(?string $email_1): self
    {
        $this->email_1 = $email_1;

        return $this;
    }

    public function getEmail2(): ?string
    {
        return $this->email_2;
    }

    public function setEmail2(?string $email_2): self
    {
        $this->email_2 = $email_2;

        return $this;
    }

    /**
     * @return Collection|Eleve[]
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): self
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves[] = $elefe;
            $elefe->setRepresentants($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): self
    {
        if ($this->eleves->contains($elefe)) {
            $this->eleves->removeElement($elefe);
            // set the owning side to null (unless already changed)
            if ($elefe->getRepresentants() === $this) {
                $elefe->setRepresentants(null);
            }
        }

        return $this;
    }

    public function getRoleId(): ?Utilisateur
    {
        return $this->role_id;
    }

    public function setRoleId(?Utilisateur $role_id): self
    {
        $this->role_id = $role_id;

        return $this;
    }

    public function getRoles(): ?Utilisateur
    {
        return $this->roles;
    }

    public function setRoles(?Utilisateur $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

        public function __toString() 
    {
        return $this->nom;
    }
}
