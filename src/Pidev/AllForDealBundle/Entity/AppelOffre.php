<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppelOffre
 *
 * @ORM\Table(name="appel_offre", indexes={@ORM\Index(name="IDX_BC56FD477764DA20", columns={"id_consommateur"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\AppelOffreRepository")
 */
class AppelOffre
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
     * @ORM\Column(name="sujet", type="string", length=255, nullable=false)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="dateDebut", type="string", length=255, nullable=false)
     */
    private $datedebut;

    /**
     * @var string
     *
     * @ORM\Column(name="dateFin", type="string", length=255, nullable=false)
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=false)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="remarque", type="string", length=255, nullable=false)
     */
    private $remarque;

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
     * @var \Membre
     *
     * @ORM\ManyToMany(targetEntity="Membre", inversedBy="idAppelOffre")
     * @ORM\JoinTable(name="appel_offre_membre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_appel_offre", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_fournisseur", referencedColumnName="id")
     *   }
     * )
     */
    private $idFournisseur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idFournisseur = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set sujet
     *
     * @param string $sujet
     * @return AppelOffre
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string 
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return AppelOffre
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
     * Set datedebut
     *
     * @param string $datedebut
     * @return AppelOffre
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return string 
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param string $datefin
     * @return AppelOffre
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return string 
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return AppelOffre
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set remarque
     *
     * @param string $remarque
     * @return AppelOffre
     */
    public function setRemarque($remarque)
    {
        $this->remarque = $remarque;

        return $this;
    }

    /**
     * Get remarque
     *
     * @return string 
     */
    public function getRemarque()
    {
        return $this->remarque;
    }

    /**
     * Set idConsommateur
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idConsommateur
     * @return AppelOffre
     */
    public function setIdConsommateur(\Pidev\AllForDealBundle\Entity\Membre $idConsommateur = null)
    {
        $this->idConsommateur = $idConsommateur;

        return $this;
    }

    /**
     * Get idConsommateur
     *
     * @return \Pidev\AllForDealBundle\Entity\Membre 
     */
    public function getIdConsommateur()
    {
        return $this->idConsommateur;
    }

    /**
     * Add idFournisseur
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idFournisseur
     * @return AppelOffre
     */
    public function addIdFournisseur(\Pidev\AllForDealBundle\Entity\Membre $idFournisseur)
    {
        $this->idFournisseur[] = $idFournisseur;

        return $this;
    }

    /**
     * Remove idFournisseur
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idFournisseur
     */
    public function removeIdFournisseur(\Pidev\AllForDealBundle\Entity\Membre $idFournisseur)
    {
        $this->idFournisseur->removeElement($idFournisseur);
    }

    /**
     * Get idFournisseur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdFournisseur()
    {
        return $this->idFournisseur;
    }
}
