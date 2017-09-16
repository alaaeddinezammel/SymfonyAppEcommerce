<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse", indexes={@ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\AdresseRepository")
 */
class Adresse
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
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255, nullable=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=false)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=255, nullable=true)
     */
    private $complement;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     * })
     */
    private $idMembre;



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
     * Set adresse
     *
     * @param string $adresse
     * @return Adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Adresse
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return Adresse
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set complement
     *
     * @param string $complement
     * @return Adresse
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string 
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set idMembre
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idMembre
     * @return Adresse
     */
    public function setIdMembre(\Pidev\AllForDealBundle\Entity\Membre $idMembre = null)
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
}
