<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluationProd
 *
 * @ORM\Table(name="evaluation_prod", indexes={@ORM\Index(name="IDX_F8F25E2FD0834EC4", columns={"id_membre"}), @ORM\Index(name="IDX_F8F25E2FF7384557", columns={"id_produit"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\EvaluationProdRepository")
 */
class EvaluationProd
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
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;


    /**
     * Set rating
     *
     * @param integer $rating
     * @return EvaluationProd
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set idMembre
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idMembre
     * @return EvaluationProd
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
     * @return EvaluationProd
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
