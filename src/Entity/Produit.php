<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_production;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $presentation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="produits")
     */
    private $artiste_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Support", mappedBy="produit_id")
     */
    private $supports;

    public function __construct()
    {
        $this->supports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateProduction(): ?string
    {
        return $this->date_production;
    }

    public function setDateProduction(string $date_production): self
    {
        $this->date_production = $date_production;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getArtisteId(): ?Artist
    {
        return $this->artiste_id;
    }

    public function setArtisteId(?Artist $artiste_id): self
    {
        $this->artiste_id = $artiste_id;

        return $this;
    }

    /**
     * @return Collection|Support[]
     */
    public function getSupports(): Collection
    {
        return $this->supports;
    }

    public function addSupport(Support $support): self
    {
        if (!$this->supports->contains($support)) {
            $this->supports[] = $support;
            $support->setProduitId($this);
        }

        return $this;
    }

    public function removeSupport(Support $support): self
    {
        if ($this->supports->contains($support)) {
            $this->supports->removeElement($support);
            // set the owning side to null (unless already changed)
            if ($support->getProduitId() === $this) {
                $support->setProduitId(null);
            }
        }

        return $this;
    }
}
