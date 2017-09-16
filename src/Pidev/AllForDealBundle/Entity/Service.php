<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="IDX_E19D9AD22E8C07C5", columns={"id_fournisseur"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\ServiceRepository")
 */
class Service
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
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fournisseur", referencedColumnName="id")
     * })
     */
    private $idFournisseur;



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
     * @return Service
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
     * Set categorie
     *
     * @param string $categorie
     * @return Service
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Service
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set idFournisseur
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idFournisseur
     * @return Service
     */
    public function setIdFournisseur(\Pidev\AllForDealBundle\Entity\Membre $idFournisseur = null)
    {
        $this->idFournisseur = $idFournisseur;

        return $this;
    }

    /**
     * Get idFournisseur
     *
     * @return \Pidev\AllForDealBundle\Entity\Membre 
     */
    public function getIdFournisseur()
    {
        return $this->idFournisseur;
    }
}
