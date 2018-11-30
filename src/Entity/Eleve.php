<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EleveRepository")
 */
class Eleve
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Evaluation", inversedBy="eleves")
     */
    private $evaluation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Matiere", inversedBy="eleves")
     */
    private $matieres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Representant", inversedBy="eleves")
     */
    private $representants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AbsenceRetard", mappedBy="noms_eleves")
     */
    private $absences;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Utilisateur", cascade={"persist", "remove"})
     */
    private $role_id;

    public function __construct()
    {
        $this->evaluation = new ArrayCollection();
        $this->matieres = new ArrayCollection();
        $this->absences = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluation(): Collection
    {
        return $this->evaluation;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluation->contains($evaluation)) {
            $this->evaluation[] = $evaluation;
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluation->contains($evaluation)) {
            $this->evaluation->removeElement($evaluation);
        }

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->contains($matiere)) {
            $this->matieres->removeElement($matiere);
        }

        return $this;
    }

    public function getRepresentants(): ?Representant
    {
        return $this->representants;
    }

    public function setRepresentants(?Representant $representants): self
    {
        $this->representants = $representants;

        return $this;
    }

    /**
     * @return Collection|AbsenceRetard[]
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(AbsenceRetard $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setNomsEleves($this);
        }

        return $this;
    }

    public function removeAbsence(AbsenceRetard $absence): self
    {
        if ($this->absences->contains($absence)) {
            $this->absences->removeElement($absence);
            // set the owning side to null (unless already changed)
            if ($absence->getNomsEleves() === $this) {
                $absence->setNomsEleves(null);
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

    public function __toString() 
    {
        return $this->nom;
    }
    public function eraseCredentials() {}

    public function getSalt() {}


}
