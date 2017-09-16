<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller {

    public function displayAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $session = $request->getSession();

        if (!$session->has('panier')) {
            $session->set('panier', array());
        }

        $panier = $session->get('panier');

        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('PidevAllForDealBundle:Produit')->findArray(array_keys($panier));

        return $this->render('PidevAllForDealBundle:Default:cart.html.twig', array('produits' => $produits, 'panier' => $panier, 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function addToCartAction(Request $request, $id) {
$em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $session = $request->getSession();

        if (!$session->has('panier')) {
            $session->set('panier', array());
        }
        $panier = $session->get('panier');
        $panier[$id] = 1;
        $session->set('panier', $panier);

        return $this->redirect($this->generateUrl('cart'));
    }

    public function removeFromCartAction(Request $request, $id) {
$em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $session = $request->getSession();
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier)) {
            unset($panier[$id]);
            $session->set('panier', $panier);
        }

        return new Response();
    }

    public function updateCartAction() {

        return new Response();
    }
    
    public function setAdresseOnSession(Request $request) {
$em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $session = $request->getSession();

        if (!$session->has('adresse')) {

            $session->set('adresse', array());
        }
        $adresse = $session->get('adresse');

        if ($request->request->get('adresse') != null) {

            $adresse = $request->request->get('adresse');
        } else {
            return $this->redirect($this->generateUrl('checkout1'));
        }

        $session->set('adresse', $adresse);

        return $this->redirect($this->generateUrl('checkout2'));
    }

    public function checkout2Action(Request $request) {
$em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        if ($request->getMethod() == 'POST') {
            $this->setAdresseOnSession($request);
        }

        return $this->render('PidevAllForDealBundle:Default:checkout2.html.twig',array('cat1' => $cat1, 'sous1' => $sous1));
    }
    
    public function setDeliveryOnSession(Request $request) {
$em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $session = $request->getSession();

        if (!$session->has('delivery')) {

            $session->set('delivery', array());
        }
        $delivery = $session->get('delivery');

        if ($request->request->get('delivery') != null) {

            $delivery = $request->request->get('delivery');
        } else {
            return $this->redirect($this->generateUrl('checkout2'));
        }

        $session->set('delivery', $delivery);

        return $this->redirect($this->generateUrl('checkout3'));
    }

    public function checkout3Action(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        if ($request->getMethod() == 'POST') {
            $this->setDeliveryOnSession($request);
        }

        $session = $request->getSession();
        $points = $session->get('points');

        return $this->render('PidevAllForDealBundle:Default:checkout3.html.twig', array('points' => $points, 'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function setPaymentOnSession(Request $request) {
$em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $session = $request->getSession();

        if (!$session->has('payment')) {

            $session->set('payment', array());
        }
        $payment = $session->get('payment');

        if ($request->request->get('payment') != null) {

            $payment = $request->request->get('payment');
        } else {
            return $this->redirect($this->generateUrl('checkout3'));
        }

        $session->set('payment', $payment);

        return $this->redirect($this->generateUrl('checkout4'));
    }

    public function checkout4Action(Request $request) {
$em = $this->getDoctrine()->getManager();

        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();

        $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        if ($request->getMethod() == 'POST') {
            $this->setPaymentOnSession($request);
        }

        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        $adresse = $em->getRepository('PidevAllForDealBundle:Adresse')->find($session->get('adresse'));
        $delivery = $session->get('delivery');
        $payment = $session->get('payment');
        $panier = $session->get('panier');
        $produits = $em->getRepository('PidevAllForDealBundle:Produit')->findArray(array_keys($panier));

        return $this->render('PidevAllForDealBundle:Default:checkout4.html.twig', array('adresse' => $adresse, 'delivery' => $delivery, 'payment' => $payment, 'produits' => $produits, 'panier' => $panier, 'cat1' => $cat1, 'sous1' => $sous1));
    }

}
