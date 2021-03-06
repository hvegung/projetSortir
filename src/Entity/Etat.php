<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\EtatRepository")
 */
class Etat
{
    const CLOTURE = "Cloturé";
    const CREATION = "En création";
    const COURS = "COURS";
    const OUVERT = "Ouvert";
    const ANNULE = "Annulé";
    const ARCHIVE = "Archivé";
    const TERMINE = "Terminé";
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", mappedBy="noEtat")
     */
    private $noSorties;

    /**
     * @Groups("group1")
     * @Assert\Length(
     *     min="3",
     *     max="30",
     *     minMessage="L'état doit être supérieur à 3 caractères",
     *     maxMessage="L'état doit être inférieur à 30 caractères")
     * @ORM\Column(type="string", length=30)
     */
    private $libelle;

    public function __construct()
    {
        $this->noSorties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getNoSorties(): Collection
    {
        return $this->noSorties;
    }

    public function addNoSorty(Sortie $noSorty): self
    {
        if (!$this->noSorties->contains($noSorty)) {
            $this->noSorties[] = $noSorty;
            $noSorty->setNoEtat($this);
        }

        return $this;
    }

    public function removeNoSorty(Sortie $noSorty): self
    {
        if ($this->noSorties->contains($noSorty)) {
            $this->noSorties->removeElement($noSorty);
            // set the owning side to null (unless already changed)
            if ($noSorty->getNoEtat() === $this) {
                $noSorty->setNoEtat(null);
            }
        }

        return $this;
    }
    
}