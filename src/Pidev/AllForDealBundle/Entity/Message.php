<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="IDX_B6BD307F55FACB43", columns={"id_emetteur"}), @ORM\Index(name="IDX_B6BD307F7DD566F8", columns={"id_recepteur"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\MessageRepository")
 */
class Message
{
    /**
     * @var \Membre
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_emetteur", referencedColumnName="id")
     * })
     */
    private $idEmetteur;

    /**
     * @var \Membre
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recepteur", referencedColumnName="id")
     * })
     */
    private $idRecepteur;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255, nullable=false)
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="date_emission", type="string", length=255, nullable=false)
     */
    private $dateEmission;

    

    /**
     * Set texte
     *
     * @param string $texte
     * @return Message
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
     * Set dateEmission
     *
     * @param string $dateEmission
     * @return Message
     */
    public function setDateEmission($dateEmission)
    {
        $this->dateEmission = $dateEmission;

        return $this;
    }

    /**
     * Get dateEmission
     *
     * @return string 
     */
    public function getDateEmission()
    {
        return $this->dateEmission;
    }

    /**
     * Set idEmetteur
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idEmetteur
     * @return Message
     */
    public function setIdEmetteur(\Pidev\AllForDealBundle\Entity\Membre $idEmetteur)
    {
        $this->idEmetteur = $idEmetteur;

        return $this;
    }

    /**
     * Get idEmetteur
     *
     * @return \Pidev\AllForDealBundle\Entity\Membre 
     */
    public function getIdEmetteur()
    {
        return $this->idEmetteur;
    }

    /**
     * Set idRecepteur
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idRecepteur
     * @return Message
     */
    public function setIdRecepteur(\Pidev\AllForDealBundle\Entity\Membre $idRecepteur)
    {
        $this->idRecepteur = $idRecepteur;

        return $this;
    }

    /**
     * Get idRecepteur
     *
     * @return \Pidev\AllForDealBundle\Entity\Membre 
     */
    public function getIdRecepteur()
    {
        return $this->idRecepteur;
    }
}
