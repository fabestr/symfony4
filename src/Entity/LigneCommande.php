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
    private $commande_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCommande(): ?Commande
    {
        return $this->commande_id;
    }

    public function setNumeroCommande(?Commande $commande_id): self
    {
        $this->numeroCommande = $commande_id;

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
