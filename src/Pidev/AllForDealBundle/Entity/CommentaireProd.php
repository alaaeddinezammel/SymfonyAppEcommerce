<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentaireProd
 *
 * @ORM\Table(name="commentaire_prod", indexes={@ORM\Index(name="IDX_5C4CD5C5D0834EC4", columns={"id_membre"}), @ORM\Index(name="IDX_5C4CD5C5F7384557", columns={"id_produit"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\CommentaireProdRepository")
 */
class CommentaireProd
{
    /**
     * @var \Membre
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     * })
     */
    private $idMembre;

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
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255, nullable=false)
     */
    private $texte;


    /**
     * Set texte
     *
     * @param string $texte
     * @return CommentaireProd
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set idMembre
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idMembre
     * @return CommentaireProd
     */
    public function setIdMembre(\Pidev\AllForDealBundle\Entity\Membre $idMembre)
    {
        $this->idMembre = $idMembre;

        return $this;
    }

    /**
     * Get idMembre
     *
     * @return \Pidev\AllForDealBundle\Entity\Membre 
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }

    /**
     * Set idProduit
     *
     * @param \Pidev\AllForDealBundle\Entity\Produit $idProduit
     * @return CommentaireProd
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
