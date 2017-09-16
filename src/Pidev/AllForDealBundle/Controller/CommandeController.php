<?php

namespace Pidev\AllForDealBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pidev\AllForDealBundle\Entity\Commande;
use Pidev\AllForDealBundle\Entity\LigneCmd;
use Symfony\Component\HttpFoundation\Response;

 

class CommandeController extends Controller {

    public function chargeAction(Request $request) {
 $em = $this->getDoctrine()->getManager();
          
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $panier = $session->get('panier');
        $payment = $session->get('payment');
        $adresseId = $session->get('adresse');
        $adresse = $em->getRepository('PidevAllForDealBundle:Adresse')->find($adresseId);
        $total = $session->get('total');
        $delivery = $session->get('delivery');

        if ($delivery == 'standard') {
            $total = $total + 5;
        } else {
            $total = $total + 10;
        }

        if ($payment == 'card') {

            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey("sk_test_SeXZpnnrWbwA3zF1BVT2pGwB");

            // Get the credit card details submitted by the form
            $token = $_POST['stripeToken'];

            // Create the charge on Stripe's servers - this will charge the user's card
            try {
                $charge = \Stripe\Charge::create(array(
                            "amount" => $total * 100, // amount in cents, again
                            "currency" => "usd",
                            "source" => $token,
                            "description" => "Example charge"
                ));

                $commande = new Commande();
                $commande->setTotal($total);
                $date = new \DateTime();
                $commande->setDate($date->format('d/m/Y'));
                $commande->setIdConsommateur($this->getUser());
                $commande->setIdAdresse($adresse);

                $em->persist($commande);
                $em->flush();

                $produits = $em->getRepository('PidevAllForDealBundle:Produit')->findArray(array_keys($panier));

                for ($i = 0; $i < Count($produits); $i++) {

                    $ligneCmd = new LigneCmd();
                    $ligneCmd->setIdCommande($commande);
                    $ligneCmd->setIdProduit($produits[$i]);
                    $ligneCmd->setQte($panier[$produits[$i]->getId()]);

                    $em->persist($ligneCmd);
                    $em->flush();
                }
            } catch (\Stripe\Error\Card $e) {
                // The card has been declined
            }
        } else {

            $commande = new Commande();
            $commande->setTotal($total);
            $date = new \DateTime();
            $commande->setDate($date->format('d/m/Y'));
            $commande->setIdConsommateur($this->getUser());
            $commande->setIdAdresse($adresse);

            $em->persist($commande);
            $em->flush();

            $produits = $em->getRepository('PidevAllForDealBundle:Produit')->findArray(array_keys($panier));

            for ($i = 0; $i < Count($produits); $i++) {

                $ligneCmd = new LigneCmd();
                $ligneCmd->setIdCommande($commande);
                $ligneCmd->setIdProduit($produits[$i]);
                $ligneCmd->setQte($panier[$produits[$i]->getId()]);

                $em->persist($ligneCmd);
                $em->flush();
            }
        }
        return $this->redirect($this->generateUrl('facture_PDF', array('id' => $commande->getId())));
    }

    public function facturePDFAction($id) {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('PidevAllForDealBundle:Commande')->findOneBy(array('idConsommateur' => $this->getUser(), 'id' => $id));

        if (!$facture) {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirect($this->generateUrl('index'));
        }

        $html = $this->renderView('PidevAllForDealBundle:Default:facturePDF.html.twig', array('facture' => $facture));

        $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetAuthor('All For Deal');
        $html2pdf->pdf->SetTitle('Facture ' . $facture->getId());
        $html2pdf->pdf->SetSubject('Facture');
        $html2pdf->pdf->SetKeywords('facture,allfordeal');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->Output('Facture.pdf');

        $response = new Response();
        $response->headers->set('Content-type', 'application/pdf');

        return $response;
    }

    public function customerOrdersAction() {
 $em = $this->getDoctrine()->getManager();
          
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $em = $this->getDoctrine()->getManager();

        $orders = $em->getRepository('PidevAllForDealBundle:Commande')->findBy(array('idConsommateur' => $this->getUser()));

        return $this->render('PidevAllForDealBundle:Default:customer_orders.html.twig', array('orders' => $orders,'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function customerOrderAction($id) {
 $em = $this->getDoctrine()->getManager();
          
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $em = $this->getDoctrine()->getManager();

        $order = $em->getRepository('PidevAllForDealBundle:Commande')->find($id);
        $lignesCmd = $em->getRepository('PidevAllForDealBundle:LigneCmd')->findBy(array('idCommande' => $id));

        return $this->render('PidevAllForDealBundle:Default:customer_order.html.twig', array('order' => $order, 'lignesCmd' => $lignesCmd));
    }

    public function adminOrdersAction() {
 $em = $this->getDoctrine()->getManager();
          
        $cat1 = $em->getRepository('PidevAllForDealBundle:Categorie')->findAll();
   
           $sous1 = $em->getRepository('PidevAllForDealBundle:SousCategorie')->findAll();
        $em = $this->getDoctrine()->getManager();

        $orders = $em->getRepository('PidevAllForDealBundle:Commande')->findAll();

        return $this->render("PidevAllForDealBundle:Admin:orders.html.twig", array('orders' => $orders,'cat1' => $cat1, 'sous1' => $sous1));
    }

    public function filterOrdersAction($item) {

        $em = $this->getDoctrine()->getManager();

        $membres = $em->getRepository('PidevAllForDealBundle:Membre')->findLike($item);

        $orders = $em->getRepository('PidevAllForDealBundle:Commande')->findArray($membres);

        $html = $this->renderView("PidevAllForDealBundle:Admin:table.html.twig", array('orders' => $orders));

        return new Response($html);
//        $serializedEntity = $this->container->get('jms_serializer')->serialize($orders, 'json');
//
//        return new Response($serializedEntity);
    }

}
