<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SortieRepository")
 */
class Sortie
{
    /**
     * @Groups("group1")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("group1")
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="noSortie", cascade={"remove"})
     */
    private $noInscriptions;

    /**
     * @Groups("group1")
     * @Assert\Length(
     *     min="3",
     *     max="30",
     *     minMessage="Le nom de la sortie doit être supérieur à 3 caractères",
     *     maxMessage="Le nom de la sortie doit être inférieur à 30 caractères")
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @Groups("group1")
     * @Groups("group1")
     * @Assert\GreaterThan("today utc", message="La date de début de sortie doit être supérieur à la date d'aujourd'hui")
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @Assert\Positive(message="La valeur doit être un nombre positif.")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @Groups("group1")
     * @Assert\GreaterThan("today utc", message="La date de clôture doit être supérieur à la date d'aujourd'hui")
     * @ORM\Column(type="datetime")
     */
    private $dateCloture;

    /**
     * @Groups("group1")
     * @Assert\Positive(message="La valeur doit être un nombre positif.")
     * @ORM\Column(type="integer")
     */
    private $nbInscriptionMax;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionInfos;



    /**
     * @Groups("group1")
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="noSorties")
     */
    private $noOrganisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="noSorties")
     */
    private $noLieu;

    /**
     * @Groups("group1")
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="noSorties")
     */
    private $noEtat;

    /**
     * @Groups("group1")
     * @ORM\ManyToOne(targetEntity="App\Entity\Site", inversedBy="noSorties")
     */
    private $noSite;


    public function __construct()
    {
        $this->noInscriptions = new ArrayCollection();
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateCloture(): ?\DateTimeInterface
    {
        return $this->dateCloture;
    }

    public function setDateCloture(\DateTimeInterface $dateCloture): self
    {
        $this->dateCloture = $dateCloture;

        return $this;
    }

    public function getNbInscriptionMax(): ?int
    {
        return $this->nbInscriptionMax;
    }

    public function setNbInscriptionMax(int $nbInscriptionMax): self
    {
        $this->nbInscriptionMax = $nbInscriptionMax;

        return $this;
    }

    public function getDescriptionInfos(): ?string
    {
        return $this->descriptionInfos;
    }

    public function setDescriptionInfos(?string $descriptionInfos): self
    {
        $this->descriptionInfos = $descriptionInfos;

        return $this;
    }



    /**
     * @return Collection|Inscription[]
     */
    public function getNoInscriptions(): Collection
    {
        return $this->noInscriptions;
    }

    public function addNoInscription(Inscription $noInscription): self
    {
        if (!$this->noInscriptions->contains($noInscription)) {
            $this->noInscriptions[] = $noInscription;
            $noInscription->setNoSortie($this);
        }

        return $this;
    }

    public function removeNoInscription(Inscription $noInscription): self
    {
        if ($this->noInscriptions->contains($noInscription)) {
            $this->noInscriptions->removeElement($noInscription);
            // set the owning side to null (unless already changed)
            if ($noInscription->getNoSortie() === $this) {
                $noInscription->setNoSortie(null);
            }
        }

        return $this;
    }

    public function getNoOrganisateur(): ?User
    {
        return $this->noOrganisateur;
    }

    public function setNoOrganisateur(?User $noOrganisateur): self
    {
        $this->noOrganisateur = $noOrganisateur;

        return $this;
    }

    public function getNoLieu(): ?Lieu
    {
        return $this->noLieu;
    }

    public function setNoLieu(?Lieu $noLieu): self
    {
        $this->noLieu = $noLieu;

        return $this;
    }

    public function getNoEtat(): ?Etat
    {
        return $this->noEtat;
    }

    public function setNoEtat(?Etat $noEtat): self
    {
        $this->noEtat = $noEtat;

        return $this;
    }

    public function getNoSite(): ?Site
    {
        return $this->noSite;
    }

    public function setNoSite(?Site $noSite): self
    {
        $this->noSite = $noSite;

        return $this;
    }




}
