<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="IDX_6EEAA67D7764DA20", columns={"id_consommateur"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\CommandeRepository")
 */
class Commande {

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
     * @ORM\Column(name="date", type="string", length=255, nullable=false)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=false)
     */
    private $total;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_consommateur", referencedColumnName="id")
     * })
     */
    private $idConsommateur;

    /**
     * @var \Adresse
     *
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_adresse", referencedColumnName="id")
     * })
     */
    private $idAdresse;
    
    /**
     * @ORM\OneToMany(targetEntity="LigneCmd", mappedBy="idCommande")
     */
    private $lignesCmd;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Commande
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Commande
     */
    public function setTotal($total) {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal() {
        return $this->total;
    }

    /**
     * Set idConsommateur
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idConsommateur
     * @return Commande
     */
    public function setIdConsommateur(\Pidev\AllForDealBundle\Entity\Membre $idConsommateur = null) {
        $this->idConsommateur = $idConsommateur;

        return $this;
    }

    /**
     * Get idConsommateur
     *
     * @return \Pidev\AllForDealBundle\Entity\Membre 
     */
    public function getIdConsommateur() {
        return $this->idConsommateur;
    }


    /**
     * Set idAdresse
     *
     * @param \Pidev\AllForDealBundle\Entity\Adresse $idAdresse
     * @return Commande
     */
    public function setIdAdresse(\Pidev\AllForDealBundle\Entity\Adresse $idAdresse = null)
    {
        $this->idAdresse = $idAdresse;

        return $this;
    }

    /**
     * Get idAdresse
     *
     * @return \Pidev\AllForDealBundle\Entity\Adresse 
     */
    public function getIdAdresse()
    {
        return $this->idAdresse;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lignesCmd = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add lignesCmd
     *
     * @param \Pidev\AllForDealBundle\Entity\LigneCmd $lignesCmd
     * @return Commande
     */
    public function addLignesCmd(\Pidev\AllForDealBundle\Entity\LigneCmd $lignesCmd)
    {
        $this->lignesCmd[] = $lignesCmd;

        return $this;
    }

    /**
     * Remove lignesCmd
     *
     * @param \Pidev\AllForDealBundle\Entity\LigneCmd $lignesCmd
     */
    public function removeLignesCmd(\Pidev\AllForDealBundle\Entity\LigneCmd $lignesCmd)
    {
        $this->lignesCmd->removeElement($lignesCmd);
    }

    /**
     * Get lignesCmd
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLignesCmd()
    {
        return $this->lignesCmd;
    }
}
