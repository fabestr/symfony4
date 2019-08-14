<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneCommandeRepository")
 */
class LigneCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Support", inversedBy="ligneCommandes")
     */
    private $numero_support;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="ligneCommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $numeroCommande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCommande(): ?Commande
    {
        return $this->numeroCommande;
    }

    public function setNumeroCommande(?Commande $numeroCommande): self
    {
        $this->numeroCommande = $numeroCommande;

        return $this;
    }

    public function getNumeroSupport(): ?Support
    {
        return $this->numero_support;
    }

    public function setNumeroSupport(?Support $numero_support): self
    {
        $this->numero_support = $numero_support;

        return $this;
    }
}
