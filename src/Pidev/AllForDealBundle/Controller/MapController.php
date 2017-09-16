<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller {

    public function MapAction() {
        $latitudes = '-24';
        $Longitudes = '142';

        return $this->render('PidevAllForDealBundle:Map:map.html.twig', array('Latitudes' => $latitudes, 'Longitudes' => $Longitudes));
    }

    public function Map1Action() {
        $em = $this->getDoctrine()->getManager();
        $map = $em->getRepository('PidevAllForDealBundle:Map')->find(1);

        $latitudes = $map->getLatitude();
        $Longitudes = $map->getLongitude();

        return $this->render('PidevAllForDealBundle:Map:map1.html.twig', array('lat' => $latitudes, 'long' => $Longitudes));
    }

}
