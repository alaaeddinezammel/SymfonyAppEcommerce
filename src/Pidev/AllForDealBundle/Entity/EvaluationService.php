<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluationService
 *
 * @ORM\Table(name="evaluation_service", indexes={@ORM\Index(name="IDX_C28E8258D0834EC4", columns={"id_membre"}), @ORM\Index(name="IDX_C28E82583F0033A2", columns={"id_service"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\EvaluationServiceRepository")
 */
class EvaluationService
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
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;


    /**
     * Set rating
     *
     * @param integer $rating
     * @return EvaluationService
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
     * Set idService
     *
     * @param \Pidev\AllForDealBundle\Entity\Service $idService
     * @return EvaluationService
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
     * @return EvaluationService
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
