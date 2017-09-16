<?php
namespace Pidev\AllForDealBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class ImageExtension extends \Twig_Extension {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getFunctions() {

        return [new \Twig_SimpleFunction('getMainImage', [$this, 'getMainImage'])];
    }

    public function getMainImage($id) {

        $image = $this->em->getRepository('PidevAllForDealBundle:Image')->findFirst($id);

        return $image;
    }

    public function getName() {

        return 'image_extension';
    }

}
