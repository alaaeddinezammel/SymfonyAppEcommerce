<?php

namespace Pidev\AllForDealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use FOS\CommentBundle\Entity\Thread as BaseThread;
/**
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Blog extends BaseThread
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    // ..... other fields

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="string", length=255, nullable=false)
     */
    private $intro;
    
    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255, nullable=false)
     */
    private $texte;
    
    	

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Product
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }
    
    function getTitre() {
        return $this->titre;
    }

    function getIntro() {
        return $this->intro;
    }

    function getTexte() {
        return $this->texte;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    function setIntro($intro) {
        $this->intro = $intro;
    }

    function setTexte($texte) {
        $this->texte = $texte;
    }

    function getUpdatedAt() {
        return $this->updatedAt;
    }
    
    function getId() {
        return $this->id;
    }
  






    
}