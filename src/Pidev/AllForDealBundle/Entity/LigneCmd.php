<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneCmd
 *
 * @ORM\Table(name="ligne_cmd", indexes={@ORM\Index(name="IDX_FDB4E3D43E314AE8", columns={"id_commande"}), @ORM\Index(name="IDX_FDB4E3D4F7384557", columns={"id_produit"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\LigneCmdRepository")
 */
class LigneCmd
{
    /**
     * @var \Commande
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_commande", referencedColumnName="id")
     * })
     */
    private $idCommande;

    /**
     * @var \Produit
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produit", referencedColumnName="id")
     * })
     */
    private $idProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="qte", type="integer", nullable=false)
     */
    private $qte;

    

    /**
     * Set qte
     *
     * @param integer $qte
     * @return LigneCmd
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return integer 
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Set idCommande
     *
     * @param \Pidev\AllForDealBundle\Entity\Commande $idCommande
     * @return LigneCmd
     */
    public function setIdCommande(\Pidev\AllForDealBundle\Entity\Commande $idCommande)
    {
        $this->idCommande = $idCommande;

        return $this;
    }

    /**
     * Get idCommande
     *
     * @return \Pidev\AllForDealBundle\Entity\Commande 
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * Set idProduit
     *
     * @param \Pidev\AllForDealBundle\Entity\Produit $idProduit
     * @return LigneCmd
     */
    public function setIdProduit(\Pidev\AllForDealBundle\Entity\Produit $idProduit)
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    /**
     * Get idProduit
     *
     * @return \Pidev\AllForDealBundle\Entity\Produit 
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }
}
