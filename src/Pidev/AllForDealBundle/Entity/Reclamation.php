<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="IDX_CE606404D0834EC4", columns={"id_membre"}), @ORM\Index(name="IDX_CE6064043F0033A2", columns={"id_service"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\ReclamationRepository")
 */
class Reclamation
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
     * @ORM\Column(name="sujet", type="string", length=255, nullable=false)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=false)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=255, nullable=true)
     */
    private $reponse;

    

    /**
     * Set sujet
     *
     * @param string $sujet
     * @return Reclamation
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
     * Set message
     *
     * @param string $message
     * @return Reclamation
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
     * Set date
     *
     * @param string $date
     * @return Reclamation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     * @return Reclamation
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string 
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set idService
     *
     * @param \Pidev\AllForDealBundle\Entity\Service $idService
     * @return Reclamation
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
     * @return Reclamation
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
