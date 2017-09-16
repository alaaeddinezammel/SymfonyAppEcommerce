<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="IDX_29A5EC272E8C07C5", columns={"id_fournisseur"}), @ORM\Index(name="IDX_29A5EC276F12807D", columns={"id_sous_categorie"})})
 * @ORM\Entity(repositoryClass="Pidev\AllForDealBundle\Repository\ProduitRepository")
 */
class Produit {

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
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="reduction", type="integer", nullable=false)
     */
    private $reduction;

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer", nullable=false)
     */
    private $points;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="date_lancement", type="string", length=255, nullable=false)
     */
    private $dateLancement;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255, nullable=false)
     */
    private $couleur;

    /**
     * @var \SousCategorie
     *
     * @ORM\ManyToOne(targetEntity="SousCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sous_categorie", referencedColumnName="id")
     * })
     */
    private $idSousCategorie;

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
     * @ORM\OneToMany(targetEntity="Image", mappedBy="images")
     */
    protected $images;
    
    
    
    
    
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
     * @return Produit
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
     * Set prix
     *
     * @param float $prix
     * @return Produit
     */
    public function setPrix($prix) {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix() {
        return $this->prix;
    }

    /**
     * Set reduction
     *
     * @param integer $reduction
     * @return Produit
     */
    public function setReduction($reduction) {
        $this->reduction = $reduction;

        return $this;
    }

    /**
     * Get reduction
     *
     * @return integer 
     */
    public function getReduction() {
        return $this->reduction;
    }

    /**
     * Set points
     *
     * @param integer $points
     * @return Produit
     */
    public function setPoints($points) {
        $this->points = $points;

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
     * Set etat
     *
     * @param string $etat
     * @return Produit
     */
    public function setEtat($etat) {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat() {
        return $this->etat;
    }

    /**
     * Set dateLancement
     *
     * @param string $dateLancement
     * @return Produit
     */
    public function setDateLancement($dateLancement) {
        $this->dateLancement = $dateLancement;

        return $this;
    }

    /**
     * Get dateLancement
     *
     * @return string 
     */
    public function getDateLancement() {
        return $this->dateLancement;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     * @return Produit
     */
    public function setCouleur($couleur) {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string 
     */
    public function getCouleur() {
        return $this->couleur;
    }

    /**
     * Set idSousCategorie
     *
     * @param \Pidev\AllForDealBundle\Entity\SousCategorie $idSousCategorie
     * @return Produit
     */
    public function setIdSousCategorie(\Pidev\AllForDealBundle\Entity\SousCategorie $idSousCategorie = null) {
        $this->idSousCategorie = $idSousCategorie;

        return $this;
    }

    /**
     * Get idSousCategorie
     *
     * @return \Pidev\AllForDealBundle\Entity\SousCategorie 
     */
    public function getIdSousCategorie() {
        return $this->idSousCategorie;
    }

    /**
     * Set idFournisseur
     *
     * @param \Pidev\AllForDealBundle\Entity\Membre $idFournisseur
     * @return Produit
     */
    public function setIdFournisseur(\Pidev\AllForDealBundle\Entity\Membre $idFournisseur = null) {
        $this->idFournisseur = $idFournisseur;

        return $this;
    }

    /**
     * Get idFournisseur
     *
     * @return \Pidev\AllForDealBundle\Entity\Membre 
     */
    public function getIdFournisseur() {
        return $this->idFournisseur;
    }
    
    
    

}
