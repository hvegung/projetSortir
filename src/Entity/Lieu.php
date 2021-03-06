<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\LieuRepository")
 */
class Lieu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", mappedBy="noLieu")
     */
    private $noSorties;

    /**
     * @Groups("groupe4")
     * @Assert\Length(
     *     min="3",
     *     max="50",
     *     minMessage="Le nom de la ville doit être supérieur à 3 caractères",
     *     maxMessage="Le nom de la ville doit être inférieur à 50 caractères")
     * @ORM\Column(type="string", length=50)
     */
    private $nomLieu;

    /**
     * @Groups("groupe4")
     * @Groups("groupe2")
     * @Assert\Length(
     *     min="3",
     *     max="100",
     *     minMessage="Le nom de la ville doit être supérieur à 3 caractères",
     *     maxMessage="Le nom de la ville doit être inférieur à 100 caractères")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $rue;

    /**
     * @Groups("groupe4")
     * @Groups("groupe2")
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitude;

    /**
     * @Groups("groupe4")
     * @Groups("groupe2")
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude;

    /**

     * @Groups("groupe2")
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="noLieux")

     */
    private $noVille;

    /**
     * @Groups("groupe4")
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="Lieux", cascade={"persist"})
     */
    private $ville;

    public function __construct()
    {
        $this->noSorties = new ArrayCollection();
    }

    public function __toString(){
        return $this->nomLieu;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLieu(): ?string
    {
        return $this->nomLieu;
    }

    public function setNomLieu(string $nomLieu): self
    {
        $this->nomLieu = $nomLieu;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

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
            $noSorty->setNoLieu($this);
        }

        return $this;
    }

    public function removeNoSorty(Sortie $noSorty): self
    {
        if ($this->noSorties->contains($noSorty)) {
            $this->noSorties->removeElement($noSorty);
            // set the owning side to null (unless already changed)
            if ($noSorty->getNoLieu() === $this) {
                $noSorty->setNoLieu(null);
            }
        }

        return $this;
    }

    public function getNoVille(): ?Ville
    {
        return $this->noVille;
    }

    public function setNoVille(?Ville $noVille): self
    {
        $this->noVille = $noVille;

        return $this;
    }

    public function getVille(): ?ville
    {
        return $this->ville;
    }

    public function setVille(?ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}