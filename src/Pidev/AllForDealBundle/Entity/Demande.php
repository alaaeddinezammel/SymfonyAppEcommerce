<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="IDX_2694D7A5D0834EC4", columns={"id_membre"}), @ORM\Index(name="IDX_2694D7A53F0033A2", columns={"id_service"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\DemandeRepository")
 */
class Demande
{
    /**
     * @var \Service
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_service", referencedColumnName="id")
     * })
     */
    private $idService;

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
     * @var string
     *
     * @ORM\Column(name="date_debut", type="string", length=255, nullable=false)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="string", length=255, nullable=false)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=false)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=false)
     */
    private $message;


    /**
     * Set dateDebut
     *
     * @param string $dateDebut
     * @return Demande
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return string 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param string $dateFin
     * @return Demande
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return string 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return Demande
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
     * Set message
     *
     * @param string $message
     * @return Demande
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set idService
     *
     * @param \Pidev\AllForDealBundle\Entity\Service $idService
     * @return Demande
     */
    public function setIdService(\Pidev\AllForDealBundle\Entity\Service $idService)
    {
        $this->idService = $idService;

        return $this;
    }

    /**
     * Get idService
     *
     * @return \Pidev\AllForDealBundle\Entity\Service 
     */
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * Set idMembre
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idMembre
     * @return Demande
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
}
