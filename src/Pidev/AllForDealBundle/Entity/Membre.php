<?php

// src/AppBundle/Entity/User.php

namespace Pidev\AllForDealBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Membre
 *
 * @ORM\Table(name="membre")
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\MembreRepository")
 */
class Membre extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var date
     *
     * @ORM\Column(name="age", type="date", nullable=false)
     */
    private $age;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="tel", type="integer", nullable=false)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255, nullable=false)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer", nullable=false)
     */
    private $points;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppelOffre", mappedBy="idFournisseur")
     */
    private $idAppelOffre;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->idAppelOffre = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Membre
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Membre
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom() {
        return $this->prenom;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Membre
     */
    public function setAge($age) {
        $this->age = $age;

        return $this;
    }
    function getTel() {
        return $this->tel;
    }
    function setTel($tel) {
        $this->tel = $tel;
    }

            /**
     * Get age
     *
     * @return integer 
     */
    public function getAge() {
        return $this->age;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return Membre
     */
    public function setGenre($genre) {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre() {
        return $this->genre;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Membre
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Membre
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set points
     *
     * @param integer $points
     * @return Membre
     */
    public function setPoints($points) {
        $this->points = 1000;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints() {
        return $this->points;
    }

    /**
     * Add idAppelOffre
     *
     * @param \Pidev\AllForDealBundle\Entity\AppelOffre $idAppelOffre
     * @return Membre
     */
    public function addIdAppelOffre(\Pidev\AllForDealBundle\Entity\AppelOffre $idAppelOffre) {
        $this->idAppelOffre[] = $idAppelOffre;

        return $this;
    }

    /**
     * Remove idAppelOffre
     *
     * @param \Pidev\AllForDealBundle\Entity\AppelOffre $idAppelOffre
     */
    public function removeIdAppelOffre(\Pidev\AllForDealBundle\Entity\AppelOffre $idAppelOffre) {
        $this->idAppelOffre->removeElement($idAppelOffre);
    }

    /**
     * Get idAppelOffre
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdAppelOffre() {
        return $this->idAppelOffre;
    }

}
