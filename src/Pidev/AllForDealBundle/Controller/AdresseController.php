<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pidev\AllForDealBundle\Entity\Adresse;
use Pidev\AllForDealBundle\Form\AdresseType;
use Symfony\Component\HttpFoundation\Response;

class AdresseController extends Controller {

    public function setQteOnSession(Request $request) {
$em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $session = $request->getSession();

        if (!$session->has('panier')) {
            $session->set('panier', array());
        }

        $panier = $session->get('panier');

        foreach (array_keys($panier) as $id) {
            $qte = $request->request->get("qte" . $id);
            $panier[$id] = $qte;
        }
        $session->set('panier', $panier);

        return $this->redirect($this->generateUrl('checkout1'));
    }

    public function checkout1Action(Request $request) {
$em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $adresse = new Adresse();
        $type = new AdresseType();
        $form = $this->createForm($type, $adresse);

        $session = $request->getSession();

        if ($request->getMethod() == 'POST') {
            $total = $request->request->get('total');
            $session->set('total', $total);
            $points = $request->request->get('points');
            $session->set('points', $points);
            $this->setQteOnSession($request);
        }

        $em = $this->getDoctrine()->getManager();

        if ($form->handleRequest($request)->isValid()) {
            $adresse->setIdMembre($this->getUser());
            $em->persist($adresse);
            $em->flush();
        }

        $total = $session->get('total');

        $adresses = $em->getRepository('PidevAllForDealBundle:Adresse')->findBy(array("idMembre" => $this->getUser()));

        return $this->render("PidevAllForDealBundle:Default:checkout1.html.twig", array("form" => $form->createView(), "adresses" => $adresses, "total" => $total,'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function deleteAction($id) {
$em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $em = $this->getDoctrine()->getManager();
        $adresse = $em->getRepository('PidevAllForDealBundle:Adresse')->find($id);
        $em->remove($adresse);
        $em->flush();

        return new Response();
    }

}
