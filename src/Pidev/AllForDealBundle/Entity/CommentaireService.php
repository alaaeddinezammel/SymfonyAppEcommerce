<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentaireService
 *
 * @ORM\Table(name="commentaire_service", indexes={@ORM\Index(name="IDX_92550881D0834EC4", columns={"id_membre"}), @ORM\Index(name="IDX_925508813F0033A2", columns={"id_service"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\CommentaireServiceRepository")
 */
class CommentaireService
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
     * @ORM\Column(name="texte", type="string", length=255, nullable=false)
     */
    private $texte;


    /**
     * Set texte
     *
     * @param string $texte
     * @return CommentaireService
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
     * Set idService
     *
     * @param \Pidev\AllForDealBundle\Entity\Service $idService
     * @return CommentaireService
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
     * @return CommentaireService
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
