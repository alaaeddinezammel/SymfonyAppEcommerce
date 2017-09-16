<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousCategorie
 *
 * @ORM\Table(name="sous_categorie", indexes={@ORM\Index(name="IDX_52743D7BC9486A13", columns={"id_categorie"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\SousCategorieRepository")
 */
class SousCategorie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categorie", referencedColumnName="id")
     * })
     */
    private $idCategorie;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return SousCategorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set idCategorie
     *
     * @param \Pidev\AllForDealBundle\Entity\Categorie $idCategorie
     * @return SousCategorie
     */
    public function setIdCategorie(\Pidev\AllForDealBundle\Entity\Categorie $idCategorie = null)
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    /**
     * Get idCategorie
     *
     * @return \Pidev\AllForDealBundle\Entity\Categorie 
     */
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }
}
